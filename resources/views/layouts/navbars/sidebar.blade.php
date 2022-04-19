<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="{{ route('home') }}" class="simple-text logo-normal">
      {{ __('Indulge Luxury') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item show {{ ($activePage == 'items' || $activePage == 'items') ? ' active' : '' }}">
        <a class="nav-link " data-toggle="collapse" href="#laravelExample" aria-expanded="true">
          <i class="material-icons">checkroom</i>
          <p>{{ __('Items Managements') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'categories') || ($activePage == 'items') ? ' show' : '' }}"" id="laravelExample">
          <ul class="nav">
            @can('category-list')
            <li class="nav-item{{ $activePage == 'categories' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('categories.index') }}">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('Categories Managements') }} </span>
              </a>
            </li>
            @endcan
            @can('brand-list')
            <li class="nav-item{{ $activePage == 'brands' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('brands.index') }}">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('Brands Managements') }} </span>
              </a>
            </li>
            @endcan

            @can('item-list')
            <li class="nav-item{{ $activePage == 'items' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('items.index') }}">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('Items Managements') }} </span>
              </a>
            </li>
            @endcan
            
          </ul>
        </div>
      </li>
      @can('client-list')
      <li class="nav-item{{ $activePage == 'clients' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('clients.index') }}">
          <i class="material-icons">face</i>
            <p>{{ __('Clients List') }}</p>
        </a>
      </li>
      @endcan
      @can('clientrequest-list')
      <li class="nav-item{{ $activePage == 'clientrequests' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('clientrequests.index') }}">
          <i class="material-icons">how_to_vote</i>
            <p>{{ __('Clients Requets List') }}</p>
        </a>
      </li>
      @endcan
      @can('sale-list')
      <li class="nav-item active-pro{{ $activePage == 'sales' ? ' active' : '' }} bg-danger">
        <a class="nav-link text-white" href="{{ route('sales.index') }}">
          <i class="material-icons">shopping_cart</i>
          <p>{{ __('Sales Operations') }}</p>
        </a>
      </li>
      @endcan
      @can('employee-list')
      <li class="nav-item{{ $activePage == 'employees' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('employees.index') }}">
          <i class="material-icons">directions_run</i>
          <p>{{ __('Employees Management') }}</p>
        </a>
      </li>
      @endcan
      @can('user-list')
      <li class="nav-item{{ $activePage == 'users' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('user.index') }}">
          <i class="material-icons">group</i>
          <p>{{ __('User Management') }}</p>
        </a>
      </li>
      @endcan

      @can('newsletter-list')
      <li class="nav-item {{ ($activePage == 'newsletters' || $activePage == 'newsletters') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#newsletternav" aria-expanded="true">
          <i class="material-icons">contact_mail</i>
          <p>{{ __('Newsletter ') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'subscribers') ? ' show' : ''}}" id="newsletternav">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'subscribers' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('subscribers.index') }}">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('Subscribers Managements') }} </span>
              </a>
            </li>
            @can('producttemplate-list')
            <li class="nav-item{{ $activePage == 'emailtemplates' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('emailtemplates.index') }}"> 
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('Templates Managements') }} </span>
              </a>
            </li>
            @endcan

            @can('producttemplate-list')
            <li class="nav-item{{ $activePage == 'producttemplates' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('producttemplates.index') }}">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('Products Templates Managements') }} </span>
              </a>
            </li>
            @endcan
            @can('campaign-list')
            <li class="nav-item{{ $activePage == 'campaigns' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('campaigns.index') }}">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('Campaigns Managements') }} </span>
              </a>
            </li>
            @endcan
            
          </ul>
        </div>
      </li>
      @endcan
      @can('expense-list')
      <li class="nav-item{{ $activePage == 'expenses' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('expenses.index') }}">
          <i class="material-icons">local_atm</i>
          <p>{{ __('Personel Expenses') }}</p>
        </a>
      </li>
      @endcan

      @can('assistance-list')
      <li class="nav-item{{ $activePage == 'assistances' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('assistances.index') }}">
          <i class="material-icons">local_atm</i>
          <p>{{ __('Sale Assistant') }}</p>
        </a>
      </li>
      @endcan

      @can('todolist-list')
      <li class="nav-item{{ $activePage == 'todolists' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('todolists.index') }}">
          <i class="material-icons">local_atm</i>
          <p>{{ __('To Do List') }}</p>
        </a>
      </li>
      @endcan

      @can('report-list')
      <li class="nav-item {{ ($activePage == 'reports' || $activePage == 'salesreports') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#reportsnav" aria-expanded="true">
         <i class="material-icons">content_paste</i>
          <p>{{ __('Reports') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'salesreports') ? ' show' : ''}}" id="reportsnav">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'salesreports' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('sales.reports') }}">
                <span class="sidebar-mini"> UP </span>
              <span class="sidebar-normal">{{ __('Sales Reports') }}</span>
              </a>
            </li>
            
            
          </ul>
        </div>
      </li>
      @endcan
    </ul>
  </div>
</div>