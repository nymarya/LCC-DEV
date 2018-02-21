<!-- search form -->
<form action="#" method="get" class="sidebar-form">
    <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Pesquisar...">
        <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
    </div>
</form>
<!-- /.search form -->
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MENU DE NAVEGAÇÃO</li>
    @include('menu.' . \App\Facades\Perfil::tipo())
</ul>
