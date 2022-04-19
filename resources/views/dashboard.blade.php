@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">supervisor_account</i>
              </div>
              <p class="card-category">Clients Number</p>
              <h3 class="card-title">{{$clients_count}}
                <small>clients</small>
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-danger">warning</i>
                <a href="{{route('clients.index')}}">visit clients...</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">store</i>
              </div>
              <p class="card-category">Revenue</p>
            <h3 class="card-title">${{$revenue_today}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">date_range</i> Last 24 Hours
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">shopping_bag</i>
              </div>
              <p class="card-category">Sales Operation</p>
            <h3 class="card-title">{{$sales_count}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">local_offer</i> Purchase registered
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">attach_money</i>
                
              </div>
              <p class="card-category">Total Sales</p>
              <h3 class="card-title">${{$sales_total}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">update</i> Just Updated
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-success">
              <div class="ct-chart" id="dailySalesChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Daily Sales</h4>
              <p class="card-category">
                <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> updated 4 minutes ago
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-warning">
              <div class="ct-chart" id="websiteViewsChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Email Subscriptions</h4>
              <p class="card-category">Last Campaign Performance</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> campaign sent 2 days ago
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-danger">
              <div class="ct-chart" id="completedTasksChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Completed Tasks</h4>
              <p class="card-category">Last Campaign Performance</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> campaign sent 2 days ago
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6 col-md-12">
          <div class="card">
            <div class="card-header card-header-tabs card-header-primary">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <span class="nav-tabs-title">Latest:</span>
                  <ul class="nav nav-tabs" data-tabs="tabs">
                    <li class="nav-item">
                      <a class="nav-link active" href="#clients_tab" data-toggle="tab">
                        <i class="material-icons">bug_report</i> Clients
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#items_tab" data-toggle="tab">
                        <i class="material-icons">code</i> Items
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#requests_tab" data-toggle="tab">
                        <i class="material-icons">cloud</i> Requests
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="clients_tab">
                  <table class="table">
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Country</th>
                      <th>City</th>
                    </tr>

                    <tbody>
                      <?php
                        $j=0;
                        ?>
                      @foreach ($latest_clients as $key => $client)
                      <tr>
                        <td>
                          {{++$j}}
                        </td>
                      <td>{{$client->name}}</td>
                      <td>{{$client->countries->country_name}}</td>
                        <td>{{$client->city}}</td>
                        
                      </tr>
                      @endforeach
                     
                      
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane" id="items_tab">
                  <table class="table">
                    <tr>
                      <th>ID</th>
                      <th>Client Name</th>
                      <th>Category</th>
                      <th>Total</th>
                    </tr>
                    <tbody>

                      <?php
                        $j=0;
                        ?>
                      {{-- @foreach ($latest_items as $key => $item)
                      <tr>
                        <td>
                          {{++$j}}
                        </td>
                      <td>{{$item->name}}</td>
                      <td>{{$item->categories->name}}</td>
                        <td>${{$item->unit_price}}</td>
                        
                      </tr>
                      @endforeach --}}
                      
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane" id="requests_tab">
                  <table class="table">
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Client</th>
                      <th>Date</th>
                    </tr>
                    <tbody>
                      <?php
                        $j=0;
                        ?>
                      @foreach ($latest_requests as $key => $request)
                      <tr>
                        <td>
                          {{++$j}}
                        </td>
                      <td>@if($request->item_id) {{$request->id}} @endif
                        @if($request->category_id) {{$request->id}} @endif</td>
                      <td>{{$request->clients->name}}</td>
                        <td>${{$request->date}}</td>
                        
                      </tr>
                      @endforeach
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12">
          <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title">Sales Operations</h4>
              <p class="card-category">Last 4 sales operations</p>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-warning">
                  <th>ID</th>
                  <th>Date</th>
                  <th>Client</th>
                  <th>Total</th>
                </thead>
                <tbody>

                  
                  @foreach ($latest_sales as $key => $sale)
                  <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $sale->date }}</td>
                    <td>{{ $sale->clients->name }} </td>
                    <td>{{ $sale->total }} $</td>
                    
                  </tr>

                  @endforeach
                 
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
<?php
$months = '[50, 17, 7,  50, 23, 18, 38, 20, 15, 21,20,3,30]';
?>
@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts({{$months}});
    });
  </script>
@endpush