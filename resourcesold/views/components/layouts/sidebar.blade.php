<nav class="mt-2"
<h1>Modules</h1>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

         
<x-menu-link class="meslink"  murl="{{url('/')}}/geolocalisation/" mtitle="MIS Settings"/>
<x-menu-link murl="{{url('/')}}/datacollect/sessions/tabs" mtitle="Data collect"/>
<x-menu-link murl="{{url('/')}}/monitoring/avancement/{{session()->get('pid')}}" mtitle="Monitoring"/>
<x-menu-link murl="{{url('/')}}/projet/{{session()->get('pid')}}/pdf/" mtitle="Repporting"/>
<x-menu-link murl="{{url('/')}}/dashboard" mtitle="MIS Dashbord"/>



</ul>
<h5>Liens</h5>
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    
<x-menu-link murl="{{url('/')}}/choisir-projet" mtitle="Choisir projet"/>

<x-menu-link murl="{{url('/')}}/assistance/issues" mtitle="Issues"/>
</ul>
</nav>
            