<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\Roles\Aluno;
use App\Models\Academics\Turma;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationData;
use App\Models\Academics\Curricula\Componente;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['validator']->extend('cpf', function ($attribute, $value, $parameters, $validator) {
            $c = preg_replace('/\D/', '', $value);
            if (strlen($c) != 11 || preg_match("/^{$c[0]}{11}$/", $c)) {
                return false;
            }
            for ($s = 10, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--);
            if ($c[9] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
                return false;
            }
            for ($s = 11, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--);
            if ($c[10] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
                return false;
            }

            return true;
        });

        $this->app['validator']->extend('cnpj', function ($attribute, $value, $parameters, $validator) {
            $buffer = substr($value, 0, 12);

            if (! is_numeric($buffer)) {
                return false;
            }

            $decode = function ($value, $pos = 5) {
                $result = 0;

                for ($i = 0; $i < strlen($value); $i++) {
                    $result = $result + ($value[$i] * $pos);
                    $pos--;
                    if ($pos < 2) {
                        $pos = 9;
                    }
                }

                return $result;
            };

            $temp = $decode($buffer);
            $buffer .= ($temp % 11) < 2 ? 0 : 11 - ($temp % 11);
            $temp = $decode($buffer, 6);
            $buffer .= ($temp % 11) < 2 ? 0 : 11 - ($temp % 11);

            if ($buffer === $value) {
                return true;
            }

            return false;
        });

        $this->app['validator']->extend('uniquestudent', function ($attribute, $value, $parameters) {
            $alunos = Aluno::where($attribute, '=', $value)->get();
            foreach ($alunos as $aluno) {
                if ($aluno->perfil->usuario->getOriginal('cpf') == $parameters[0]) {
                    return false;
                }
            }

            return true;
        });

        $this->app['validator']->extend('turmalotada', function ($attribute, $value, $parameters) {
            $alunos = Aluno::where($attribute, '=', $value)->get()->count();
            $vagas = Turma::findOrFail($value)->vagas;
            if ($alunos >= $vagas) {
                return false;
            }

            return true;
        });

        $this->app['validator']->extend('hash', function ($attribute, $value, $parameters) {
            return Hash::check($value, $parameters[0]);
        });

        $this->app['validator']->extend('min_db', function ($attribute, $value, $parameters) {
            if (count($parameters) < 3) {
                return false;
            }

            if (count($parameters) > 3) {
                list($table, $column, $other, $value) = $parameters;

                return $value >= $this->app['db']->table($table)
                        ->where($other, $value)
                        ->select($column)->first()->{$column};
            }

            list($table, $column, $other) = $parameters;

            return $value >= $this->app['db']->table($table)
                    ->where('id', $this->app['request']->get($other))
                    ->select($column)->first()->{$column};
        });

        $this->app['validator']->replacer('min_db', function ($message, $attribute, $rule, $parameters) {
            if (count($parameters) > 3) {
                list($table, $column, $other, $value) = $parameters;

                return str_replace(':min', $this->app['db']->table($table)
                    ->where($other, $value)
                    ->select($column)->first()->{$column}, $message);
            }

            list($table, $column, $other) = $parameters;

            return str_replace(':min', $this->app['db']->table($table)
                ->where('id', $this->app['request']->get($other))
                ->select($column)->first()->{$column}, $message);
        });

        $this->app['validator']->extend('date_range', function ($attribute, $value, $parameters) {
            $datas = explode(' - ', $value);

            if (count($datas) > 1) {
                list($first, $last) = explode(' - ', $value);

                return (Carbon::createFromFormat('d/m/Y', $first)->format('d/m/Y')
                    . ' - ' . Carbon::createFromFormat('d/m/Y', $last)->format('d/m/Y')
                    === $value);
            }

            return false;
        });

        $this->app['validator']->extend('trabalho_unico', function ($attribute, $value, $parameters, $validator) {
            $tcc = $validator->getData()['requer_tcc'];
            $aplicativo = $validator->getData()['projeto_aplicativo'];
            $intervencao = $validator->getData()['projeto_intervencao'];

            return ! (($tcc == 1 && $aplicativo == 1)
                || ($tcc == 1 && $intervencao == 1)
                || ($aplicativo == 1 && $intervencao == 1));
        });

        // Verifica se a soma das cargas horárias na descrição de CH do professor
        // é igual à CH do componente da oferta
        $this->app['validator']->extend('soma_carga_horaria', function ($attribute, $value, $parameters, $validator) {
            $id = 0;
            if (! array_key_exists('componente_id', $validator->getData())) {
                //dd($parameters);
                if (count($parameters) > 0) {
                    //Recupera id pelo parametro passado
                    $id = intval($parameters[0]);
                } else {
                    return false;
                }
            }

            //Se o id não tiver sido passado por parametro, ainda não foi criado
            $id = ($id == 0) ? intval($validator->getData()['componente_id']) : $id;
            $componente = Componente::find($id);
            $soma = 0;

            foreach ($validator->getData()['professores'] as $professor) {
                $soma += $professor['carga_horaria'];
            }

            return $soma == $componente->carga_horaria;
        });

        $this->app['validator']->extend('soma_carga_horaria_pratica', function ($attribute, $value, $parameters, $validator) {
            $id = 0;
            if (! array_key_exists('componente_id', $validator->getData())) {
                //dd($parameters);
                if (count($parameters) > 0) {
                    //Recupera id pelo parametro passado
                    $id = intval($parameters[0]);
                } else {
                    return false;
                }
            }

            //Se o id não tiver sido passado por parametro, ainda não foi criado
            $id = ($id == 0) ? intval($validator->getData()['componente_id']) : $id;
            $componente = Componente::find($id);
            $soma = 0;

            foreach ($validator->getData()['professores_pratica'] as $professor) {
                $soma += $professor['carga_horaria_pratica'];
            }

            return $soma == $componente->praticas->first()->carga_horaria;
        });

        $this->app['validator']->extend('soma_carga_horaria_estagio', function ($attribute, $value, $parameters, $validator) {
            $id = 0;
            if (! array_key_exists('componente_id', $validator->getData())) {
                //dd($parameters);
                if (count($parameters) > 0) {
                    //Recupera id pelo parametro passado
                    $id = intval($parameters[0]);
                } else {
                    return false;
                }
            }

            //Se o id não tiver sido passado por parametro, ainda não foi criado
            $id = ($id == 0) ? intval($validator->getData()['componente_id']) : $id;
            $componente = Componente::find($id);
            $soma = 0;

            foreach ($validator->getData()['supervisores_estagio'] as $professor) {
                $soma += $professor['carga_horaria_estagio'];
            }

            return $soma == $componente->estagios->first()->carga_horaria;
        });

        $this->app['validator']->extend(
            'range',
            function ($attribute, $value, $parameters) {
                list($lower, $upper) = $parameters;

                if (! is_array($value)) {
                    return false;
                }

                return array_key_exists($lower, $value)
                    && array_key_exists($upper, $value);
            }
        );

        $this->app['validator']->extend(
            'separate',
            function ($attribute, $value, $parameters, Validator $validator) {
                list($lower, $upper) = $parameters;

                $attributeName = ValidationData::getLeadingExplicitAttributePath(
                    preg_replace('/\d/', '*', $attribute)
                );

                $attributeData = collect($validator->getData()[$attributeName])
                    ->mapWithKeys(function ($data, $key) use ($attributeName) {
                        return [$attributeName . '.' . $key => $data];
                    })->except($attribute);

                foreach ($attributeData as $key => $range) {
                    if ($range[$upper] >= $value[$lower]
                        && $range[$lower] <= $value[$upper]) {
                        return false;
                    }
                }

                return true;
            }
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
