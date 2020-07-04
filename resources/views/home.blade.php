@extends('layouts.dashboard')
@section('titulo')
<title>Sistema- Inicio</title>
@endsection
@section('content')
<div class="container">
             <!-- Content Row -->
             <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-4 mb-4">
                  <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Ganancia en ventas del Día</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">S/.{{ $total_dia }}</div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
    
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-4 mb-4">
                  <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total de repartidores</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_repartidores }}</div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-motorcycle fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
    
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-4 mb-4">
                  <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pedidos Faltantes</div>
                          <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $faltantes }}</div>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                      <div class="card-body">
                        <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Balones Premium</div>
                            <div class="row no-gutters align-items-center">
                              <div class="col-auto">
                                @if($almacen === null)
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">No se registro el día de hoy</div>
                                @else
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $almacen->balon_lleno_premiun }}</div>
                                @endif
                              </div>
                            </div>
                          </div>
                          <div class="col-auto">
                            <i class="fas fa-fill fa-2x text-gray-300"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                      <div class="card-body">
                        <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Balones Premium Vacios</div>
                            <div class="row no-gutters align-items-center">
                              <div class="col-auto">
                                @if($almacen === null)
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">No se registro el día de hoy</div>
                                @else
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $almacen->balon_vacio_premiun }}</div>
                                @endif
                              </div>
                            </div>
                          </div>
                          <div class="col-auto">
                            <i class="fas fa-exclamation-circle fa-2x text-gray-300"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                      <div class="card-body">
                        <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Balones Normales</div>
                            <div class="row no-gutters align-items-center">
                              <div class="col-auto">
                                @if($almacen === null)
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">No se registro el día de hoy</div>
                                @else
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $almacen->balon_lleno_normal }}</div>
                                @endif
                              </div>
                            </div>
                          </div>
                          <div class="col-auto">
                            <i class="fas fa-fill fa-2x text-gray-300"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                      <div class="card-body">
                        <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Balones Normales Vacios</div>
                            <div class="row no-gutters align-items-center">
                              <div class="col-auto">
                                @if($almacen === null)
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">No se registro el día de hoy</div>
                                @else
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $almacen->balon_vacio_normal }}</div>
                                @endif
                              </div>
                            </div>
                          </div>
                          <div class="col-auto">
                            <i class="fas fa-exclamation-circle fa-2x text-gray-300"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
    
              <!-- Content Row -->
              <div class="row">
                <div class="col-lg-6 mb-4">
    
                    <!-- Illustrations -->
                    <div class="card shadow mb-4">
                      <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Pasos en el sistema</h6>
                      </div>
                      <div class="card-body">
                        <ol>
                            <li value="1"> Registra a todos tus repartidores </li>
                            
                            <li>Cada dia debes registrar el total de tu almacen en el modulo gestionar almacen</li>
                            
                            <li>Registra las ventas  </li>
                            <li>Para tomar asistencia, asegurate que todos tus repartidores esten registraos</li>
                            
                            </ol>
                            <div class="text-center">
                                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="{{ asset('img/undraw_refreshing_beverage_td3r.svg') }}" alt="">
                              </div>
                      </div>
                    </div>
      
                    <!-- Approach -->
                    
      
                  </div>
                <!-- Content Column -->
                <div class="col-lg-6 mb-4">
    
                  <!-- Project Card Example -->
                  <div class="card shadow mb-4">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Recomendaciones</h6>
                    </div>
                    <div class="card-body">
                      <ol>
                          <li value="1"> No olvides cerrar sesión</li>
                          
                          <li>No inicies sesión con una cuenta en mas de dos dispositivos diferentes</li>
                          
                          <li>Registra todos los campos requeridos para evitar problemas de registro  </li>
                          
                          </ol>
                          <div class="text-center">
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="{{ asset('img/undraw_new_notifications_fhvw.svg') }}" alt="">
                          </div>
                    </div>
                  </div>
    
                </div>
    
                
              </div>

</div>
@endsection
