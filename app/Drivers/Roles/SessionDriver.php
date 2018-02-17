<?php

namespace App\Drivers\Roles;

use App\Models\Perfil;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Session\Session;
use App\Exceptions\AuthorizationException;
use Symfony\Component\HttpFoundation\Request;

class SessionDriver
{
    /**
     * @var \Illuminate\Contracts\Session\Session
     */
    private $sessao;

    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    private $requisicao;

    /**
     * @var \Illuminate\Contracts\Auth\Guard
     */
    private $guarda;

    /**
     * @var \App\Models\Perfil
     */
    private $perfil;

    /**
     * Construtor de SessionDriver.
     */
    public function __construct(Guard $guard, Session $session, Request $request = null)
    {
        $this->guarda = $guard;
        $this->sessao = $session;
        $this->requisicao = $request;
    }

    /**
     * Identificador único para o valor na sessão.
     *
     * @return string
     */
    protected function getNome()
    {
        return 'perfil_'.sha1(static::class);
    }

    /**
     * Atualiza a sessão com o ID fornecido.
     *
     * @param  int  $id
     * @return void
     */
    protected function atualizarSessao($id)
    {
        $this->sessao->put($this->getNome(), $id);

        $this->sessao->migrate(true);
    }

    /**
     * Define o perfil do usuário atual.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return $this
     */
    public function definir(Perfil $perfil)
    {
        $this->atualizarSessao($perfil->id);

        $this->perfil = $perfil;

        $this->requisicao->attributes->set('perfil', $this->perfil);

        return $this;
    }

    /**
     * Verifica se o usuário selecionou algum perfil ou não.
     *
     * @return bool
     */
    public function checar()
    {
        return ! is_null($this->recuperar());
    }

    /**
     * Recupera o perfil associado na requisição.
     *
     * @return \App\Models\Perfil|null
     */
    public function recuperar()
    {

        if (! is_null($this->perfil)) {
            return $this->perfil;
        }

        if (! $this->guarda->check()) {
            return;
        }

        $id = $this->sessao->get($this->getNome());
        $this->perfil = null;
        if (! is_null($id)) {
            $this->perfil = $this->guarda->user()
                ->perfis()->with('papel')->find($id);
        }

        $this->requisicao->attributes->set('perfil', $this->perfil);
        return $this->perfil;
    }

    /**
     * Recupera o identificador único do perfil.
     *
     * @return bool
     */
    public function id()
    {
        return $this->recuperar() ? $this->recuperar()->id : null;
    }

    /**
     * Recupera o modelo de papel do perfil associado.
     *
     * @return \App\Models\Traits\Papel|null
     */
    public function papel()
    {
        return $this->recuperar() ? $this->recuperar()->papel : null;
    }

    /**
     * Recupera a instituição associada ao perfil.
     *
     * @return \App\Models\Instituicao|null
     */
    public function instituicao()
    {
        return $this->recuperar() ? $this->papel()->hospital : null;
    }

    /**
     * Recupera o tipo de perfil associado.
     *
     * @return string|null
     */
    public function tipo()
    {
        return $this->recuperar() ? $this->recuperar()->tipo : null;
    }

    /**
     * Determina se o usuário definiu algum perfil.
     *
     * @return \App\Models\Perfil|null
     * @throws \App\Exceptions\AuthorizationException
     */
    public function verificar()
    {
        if (! is_null($perfil = $this->recuperar())) {
            return $perfil;
        }

        throw new AuthorizationException();
    }
}
