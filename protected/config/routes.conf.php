<?php
// rutas para AdminController
$route['*']['/admin'] = array('admin/AdminController', 'index');
$route['*']['/admin/user'] = array('admin/AdminController', 'user');
$route['*']['/admin/logout'] = array('admin/AdminController', 'logout');
$route['*']['/admin/home'] = array('admin/AdminController', 'home');
$route['*']['/blog/all'] = array('BlogController', 'showAll');
//hotel/name
$route['*']['/hotel/name'] = array('ToursControllerWeb', 'hotelName');

// rutas para RolesController
$route['*']['/admin/roles'] = array('admin/RolesController', 'index');
$route['*']['/admin/roles/edit/:pindex'] = array('admin/RolesController', 'edit');
$route['*']['/admin/roles/add'] = array('admin/RolesController', 'add');
$route['*']['/admin/roles/save'] = array('admin/RolesController', 'save');
$route['*']['/admin/roles/delete'] = array('admin/RolesController', 'delete');
// rutas para RoutesController
$route['*']['/admin/routes'] = array('admin/RoutesController', 'index');
$route['*']['/admin/routes/:type_rate'] = array('admin/RoutesController', 'index');
$route['*']['/admin/routes/:filtro/:texto/:type_rate/page/:pindex'] = array('admin/RoutesController', 'index');
$route['*']['/admin/routes/:filtro/:texto/:type_rate/:id_agency/page/:pindex'] = array('admin/RoutesController', 'index');
$route['*']['/admin/routes/:filtro/:texto/:type_rate/:id_agency/:acompany/page/:pindex'] = array('admin/RoutesController', 'index');

$route['*']['/admin/routes/add'] = array('admin/RoutesController', 'add');
$route['*']['/admin/routes/add_especial'] = array('admin/RoutesController', 'add_Net_especial');
$route['*']['/admin/routes/save'] = array('admin/RoutesController', 'save');
$route['*']['/admin/routes/edit/:pindex'] = array('admin/RoutesController', 'edit');
$route['*']['/admin/routes/delete'] = array('admin/RoutesController', 'delete');
$route['*']['/admin/routes/trip_from/:trip'] = array('admin/RoutesController', 'trip_from');
$route['*']['/admin/routes/trip_to/:trip/:from'] = array('admin/RoutesController', 'trip_to');

// rutas para TripsController
$route['*']['/admin/trips'] = array('admin/TripsController', 'index');
$route['*']['/admin/trips/:filtro/:texto/page/:pindex'] = array('admin/TripsController', 'index');
$route['*']['/admin/trips/add'] = array('admin/TripsController', 'add');
$route['*']['/admin/trips/save'] = array('admin/TripsController', 'save');
$route['*']['/admin/trips/edit/:pindex'] = array('admin/TripsController', 'edit');
$route['*']['/admin/trips/delete'] = array('admin/TripsController', 'delete');
$route['*']['/admin/trips/passengers'] = array('admin/TripsController', 'passengers');
$route['*']['/admin/trips/passengers/:trip/:fecha_ini'] = array('admin/TripsController', 'passengers');
$route['*']['/admin/trips/passengers/:trip/:fecha_ini/page/:pindex'] = array('admin/TripsController', 'passengers');
$route['*']['/admin/trips/passengers/save'] = array('admin/TripsController', 'save_luggage');
$route['*']['/admin/trips/passengers/bus'] = array('admin/TripsController', 'passengers_bus_one');
$route['*']['/admin/trips/reserves-bus-area-add/:area/:bus'] = array('admin/TripsController', 'reserves_bus_area_add');
$route['*']['/admin/trips/reserves-bus-area-dell/:area'] = array('admin/TripsController', 'reserves_bus_area_dell');
$route['*']['/admin/trips/reserves-bus-area-save'] = array('admin/TripsController', 'reserves_bus_area_save');
$route['*']['/admin/trips/passengers/bus-two'] = array('admin/TripsController', 'passengers_bus_two');
$route['*']['/admin/trips/reserves-bus-add/:bus/:r_string'] = array('admin/TripsController', 'reserves_bus_add');

$route['*']['/admin/trips/reserves-bus-order/:bus/:c_order/:invertir'] = array('admin/TripsController', 'ordernar_bus');
$route['*']['/admin/trips/reserves-bus-save'] = array('admin/TripsController', 'reserves_bus_save');
$route['*']['/admin/trips/passengers/bus/list/:bus/:trip/:fecha/:order'] = array('admin/TripsController', 'pdf');

$route['*']['/admin/trips/passengers/bus/list/pdf'] = array('admin/TripsController', 'pdf');



$route['*']['/form/:dato'] = array('admin/TripsController', 'form');

//ruta para ClienteController
$route['*']['/admin/clientes'] = array('admin/ClienteController', 'index');
$route['*']['/admin/clientes/:filtro/:texto/page/:pindex'] = array('admin/ClienteController', 'index');
$route['*']['/admin/clientes/add'] = array('admin/ClienteController', 'add');
$route['*']['/admin/clientes/addClient'] = array('admin/ClienteController', 'addClient');
$route['*']['/admin/clientes/addClient/:username/:firstname/:lastname/:phone'] = array('admin/ClienteController', 'addClient');

$route['*']['/admin/clientes/pagador/:username/:firstname/:lastname/:phone/:id'] = array('admin/ClienteController', 'addPagador');
$route['*']['/admin/clientes/pagador/cargarDatos/:id'] = array('admin/ClienteController', 'datosCliente');

$route['*']['/admin/clientes/save'] = array('admin/ClienteController', 'save');
$route['*']['/admin/clientes_pagador/save'] = array('admin/ClienteController', 'savepagador');

//Cargar iden, fecha Modal
$route['*']['/modal/iden/:id/:dateT'] = array('MainController', 'modalTripPuesto');
$route['*']['/modal/modal/iden/:id'] = array('MainController', 'changeData');
$route['*']['/modal/sesion/iden/:time/:id'] = array('MainController', 'timeSesion');

//para recordar la clave de usuario. Envía un mail TTTTTTTTTT
$route['*']['/recover/recoverPass/:mail'] = array('MainController', 'recoverPass');

// cargar otra cosa
$route['*']['/timeTH/trip_departure/:time'] = array('MainController', 'pickupDropoff');

$route['*']['/form/round/:to/:from/:departure/:returning/:adult/:child'] = array('MainController', 'formPrincipalRound');
$route['*']['/cargarTablaDinamica/:adult/:child'] = array('MainController', 'cargarTablaDinamica');
$route['*']['/cargarPrecioDinamico/:adult/:child'] = array('MainController', 'cargarPrecioDinamico');

$route['*']['/form/oneway/:to/:from/:departure/:adult/:child'] = array('MainController', 'formPrincipalOneway');

//resident
$route['*']['/form/resident/:resident/:zip'] = array('MainController', 'formResidentT');

//id precio ida e id precio vuelta
$route['*']['/form/idprecio/:idPrecioIda/:idPrecioVuelta/:trip1/:trip2'] = array('MainController', 'formIdPrecio');

$route['*']['/mirador/sesion/:id'] = array('MainController', 'miraSesion');

$route['*']['/navegante/tamara'] = array('MainController', 'naveganteT');

$route['*']['/naveganteDescarado/tamara'] = array('MainController', 'naveganteDescaradoT');

//carga noVaAServir
$route['*']['/nada/changeNada/idt/:idt'] = array('MainController', 'noVaAServir');

//cargar/pax/
$route['*']['/mostrar/actual'] = array('MainController', 'mostrar');
$route['*']['/cargar/pax/:promo/:trip_no/:tipo/:click'] = array('MainController', 'cargarPax');
$route['*']['/cargar/tipo1/:trip_no/:tipo/:carga'] = array('MainController', 'puestosTrip');
$route['*']['/admin/clientes/edit/:pindex'] = array('admin/ClienteController', 'edit');
$route['*']['/admin/clientes/delete'] = array('admin/ClienteController', 'delete');
$route['*']['/leader/ajax'] = array('admin/ReservasController', 'ajaxcliente');
$route['*']['/leader/ajax2/:id/:id2'] = array('admin/ReservasController', 'ajaxcliente2');
$route['*']['/consul/trips/:from/:to/:fecha/:resid/:fromto/:tipo/:agency'] = array('admin/ReservasController', 'trips');
/*$route['*']['/consul/trips/:from/:to'] = array('admin/ReservasController', 'trips');*/
$route['*']['/consul/trips/poner/:trip/:fecha/:resid/:from/:to/:tipo'] = array('admin/ReservasController', 'trips2');
$route['*']['/consul/exten/:id'] = array('MainController', 'exten');
$route['*']['/consul/superclub/:id'] = array('admin/ReservasController', 'superclub');
$route['*']['/consul/extenp/:id/:id2/:transAdult/:transChild/:type_rate'] = array('admin/ReservasController', 'extenprice');
$route['*']['/consul/datoss/:id/:transAdult/:transChild'] = array('admin/ReservasController', 'extra');



//ruta para Buses
$route['*']['/admin/bus'] = array('admin/BusController', 'index');
$route['*']['/admin/bus/:filtro/:texto/page/:pindex'] = array('admin/BusController', 'index');
$route['*']['/admin/bus/add'] = array('admin/BusController', 'add');
$route['*']['/admin/bus/save'] = array('admin/BusController', 'save');
$route['*']['/admin/bus/edit/:pindex'] = array('admin/BusController', 'edit');
$route['*']['/admin/bus/delete'] = array('admin/BusController', 'delete');

//crud de areas
$route['*']['/admin/areas'] = array('admin/AreaController', 'index');
$route['*']['/admin/areas/:filtro/:texto/page/:pindex'] = array('admin/AreaController', 'index');
$route['*']['/admin/areas/add'] = array('admin/AreaController', 'add');
$route['*']['/admin/areas/save'] = array('admin/AreaController', 'save');
$route['*']['/admin/areas/edit/:pindex'] = array('admin/AreaController', 'edit');
$route['*']['/admin/areas/delete'] = array('admin/AreaController', 'delete');


//crud de PICK – UP / DROP – OFF
$route['*']['/admin/pickup-dropoff'] = array('admin/PickdropController', 'index');
$route['*']['/admin/pickup-dropoff/:filtro/:texto/page/:pindex'] = array('admin/PickdropController', 'index');
$route['*']['/admin/pickup-dropoff/add'] = array('admin/PickdropController', 'add');
$route['*']['/admin/pickup-dropoff/save'] = array('admin/PickdropController', 'save');
$route['*']['/admin/pickup-dropoff/edit/:pindex'] = array('admin/PickdropController', 'edit');
$route['*']['/admin/pickup-dropoff/delete'] = array('admin/PickdropController', 'delete');

//crud de PICK – UP / DROP – OFF extension
$route['*']['/admin/pickup-dropoff/ext'] = array('admin/PickextController', 'index');
$route['*']['/admin/pickup-dropoff/ext/:filtro/:texto/page/:pindex'] = array('admin/PickextController', 'index');
$route['*']['/admin/pickup-dropoff/ext/add'] = array('admin/PickextController', 'add');
$route['*']['/admin/pickup-dropoff/ext/save'] = array('admin/PickextController', 'save');
$route['*']['/admin/pickup-dropoff/ext/edit/:pindex'] = array('admin/PickextController', 'edit');
$route['*']['/admin/pickup-dropoff/ext/delete'] = array('admin/PickextController', 'delete');


//crud de Extension
$route['*']['/admin/extension'] = array('admin/ExtController', 'index');
$route['*']['/admin/extension/:filtro/:texto/page/:pindex'] = array('admin/ExtController', 'index');
$route['*']['/admin/extension/add'] = array('admin/ExtController', 'add');
$route['*']['/admin/extension/save'] = array('admin/ExtController', 'save');
$route['*']['/admin/extension/edit/:pindex'] = array('admin/ExtController', 'edit');
$route['*']['/admin/extension/delete'] = array('admin/ExtController', 'delete');


//crud de Driver
$route['*']['/admin/driver'] = array('admin/DriverController', 'index');
$route['*']['/admin/driver/:filtro/:texto/page/:pindex'] = array('admin/DriverController', 'index');
$route['*']['/admin/driver/add'] = array('admin/DriverController', 'add');
$route['*']['/admin/driver/save'] = array('admin/DriverController', 'save');
$route['*']['/admin/driver/edit/:pindex'] = array('admin/DriverController', 'edit');
$route['*']['/admin/driver/delete'] = array('admin/DriverController', 'delete');
$route['*']['/admin/driver/img'] = array('admin/DriverController', 'img');
$route['*']['/admin/driver/ajax'] = array('admin/DriverController', 'ajax');
$route['*']['/admin/driver/ajax2'] = array('admin/DriverController', 'deleteimg');

//crud de Driver / accient and drag
$route['*']['/admin/driver/accident-drag'] = array('admin/AccidentController', 'index');
$route['*']['/admin/driver/accident-drag/:filtro/:texto/page/:pindex'] = array('admin/AccidentController', 'index');
$route['*']['/admin/driver/accident-drag/add'] = array('admin/AccidentController', 'add');
$route['*']['/admin/driver/accident-drag/save'] = array('admin/AccidentController', 'save');
$route['*']['/admin/driver/accident-drag/edit/:pindex'] = array('admin/AccidentController', 'edit');
$route['*']['/admin/driver/accident-drag/delete'] = array('admin/AccidentController', 'delete');


//crud de Driver / Type_Services
$route['*']['/admin/driver/type-service'] = array('admin/Type_ServiceController', 'index');
$route['*']['/admin/driver/type-service/:filtro/:texto/page/:pindex'] = array('admin/Type_ServiceController', 'index');
$route['*']['/admin/driver/type-service/add'] = array('admin/Type_ServiceController', 'add');
$route['*']['/admin/driver/type-service/save'] = array('admin/Type_ServiceController', 'save');
$route['*']['/admin/driver/type-service/edit/:pindex'] = array('admin/Type_ServiceController', 'edit');
$route['*']['/admin/driver/type-service/delete'] = array('admin/Type_ServiceController', 'delete');

//crud de Driver / Services Driver
$route['*']['/admin/driver/service-driver'] = array('admin/Service_DriverController', 'index');
$route['*']['/admin/driver/service-driver/:filtro/:texto/page/:pindex'] = array('admin/Service_DriverController', 'index');
$route['*']['/admin/driver/service-driver/add'] = array('admin/Service_DriverController', 'add');
$route['*']['/admin/driver/service-driver/save'] = array('admin/Service_DriverController', 'save');
$route['*']['/admin/driver/service-driver/edit/:pindex'] = array('admin/Service_DriverController', 'edit');
$route['*']['/admin/driver/service-driver/delete'] = array('admin/Service_DriverController', 'delete');


//Include routes tours admin
$route['*']['/admin/tours'] = array('admin/ToursController', 'index');
$route['*']['/admin/tours/quoted'] = array('admin/ToursController', 'quoted');
//filtros autocomplete...!!
$route['*']['/admin/tours/loaddatos'] = array('admin/ToursController', 'loadDatos');
$route['*']['/admin/tours/cargardatos/:id/:id2'] = array('admin/ToursController', 'cargarDatos');
$route['*']['/admin/tours/loadcompany/:txt'] = array('admin/ToursController', 'loadcompany');
$route['*']['/admin/tours/loademploy/:txt'] = array('admin/ToursController', 'loademploy');
$route['*']['/admin/tours/typeTranspor1/:id'] = array('admin/ToursController', 'typeTranspor1');
$route['*']['/admin/tours/typeTranspor2/:id'] = array('admin/ToursController', 'typeTranspor2');
$route['*']['/admin/tours/selectTrip1/:from/:to/:fecha/:totalpax/:tipo_pass/:agency'] = array('admin/ToursController', 'selectTrip1');
$route['*']['/admin/tours/selectTrip2/:from/:to/:fecha/:totalpax/:tipo_pass/:agency'] = array('admin/ToursController', 'selectTrip2');
$route['*']['/admin/tours/comisionTransport/:trip/:tipo'] = array('admin/ToursController', 'comisionTransport');
$route['*']['/admin/tours/valorTransfer/:tipo1/:tipo2/:child/:adult/:type_rate/:fecha'] = array('admin/ToursController', 'valorTransfer');
$route['*']['/admin/tours/priceexten/:id/:id_agency/:num'] = array('admin/ToursController', 'priceexten');
$route['*']['/admin/tours/habitacionesAginables/:totaladult/:select'] = array('admin/ToursController', 'habitacionesAsignables');
$route['*']['/admin/tours/habitaciones/:adult/:child'] = array('admin/ToursController', 'habitaciones');
$route['*']['/admin/tours/habitaciones2/:num/:adult/:child'] = array('admin/ToursController', 'habitaciones');
$route['*']['/admin/tours/acomodacion/:rooms/:r_adult1/:r_adult2/:r_adult3/:r_adult4/:r_child1/:r_child2/:r_child3/:r_child4'] = array('admin/ToursController', 'acomodacion');

$route['*']['/admin/tours/selecthotel/:id/:fecha_salida/:fecha_retorno/:room1/:room2/:room3/:room4/:id_agency/:nochesfree/:free_night_buffet'] = array('admin/ToursController', 'selectHotel');
$route['*']['/admin/tours/redishotels/:id_tour/:id/:fecha_salida/:fecha_retorno/:room1/:room2/:room3/:room4/:id_agency/:buffet/:nochesfree/:free_night_buffet/:nhotels/:nightsr'] = array('admin/ToursController', 'redisHotel');
$route['*']['/admin/tours/add_night_hotel/:id/:diff'] = array('admin/ToursController','add_hotels_nights');
$route['*']['/admin/tours/reloadhotels/:id'] = array('admin/ToursController', 'reloadHotels');
$route['*']['/admin/tours/selectpark/:id_park/:id_group/:adult/:child/:fecha_salida/:fecha_retorno/:platinum/:id_agency'] = array('admin/ToursController', 'selectPark');

$route['*']['/admin/tours/gastionpark/:id_park/:opcion/:adult/:child'] = array('admin/ToursController', 'gestionAdminision');

$route['*']['/admin/tours/gastionTransorLocal/:id_park/:opcion/:adult/:child'] = array('admin/ToursController', 'gestionTransportLocal');

$route['*']['/admin/tours/delete_park/:id_park/:adult/:child'] = array('admin/ToursController', 'borrar_park');

$route['*']['/admin/tours/listTablaPark/:adult/:child'] = array('admin/ToursController', 'listTablaPark');

$route['*']['/admin/tours/:filtro/:texto/page/:pindex'] = array('admin/ToursController', 'index');
$route['*']['/admin/tours/add'] = array('admin/ToursController', 'add');
$route['*']['/admin/tours/save'] = array('admin/ToursController', 'save');

$route['*']['/admin/tours/saveedit'] = array('admin/ToursController', 'save_edit');
$route['*']['/admin/tours/edit/rastro/:id'] = array('admin/ToursController', 'detalles_rastro');

$route['*']['/admin/tours/payment'] = array('admin/ToursController', 'pagoWeb');
$route['*']['/transaction/admin/tours/payment'] = array('admin/ToursController', 'estado_pago');
$route['*']['/transaction/admin/tours/approval'] = array('admin/ToursController', 'response_aproval');
$route['*']['/transaction/admin/tours/decline'] = array('admin/ToursController', 'response_decline');
$route['*']['/admin/tours/edit/:pindex'] = array('admin/ToursController', 'edit');
$route['*']['/admin/tours/delete'] = array('admin/ToursController', 'delete');
$route['*']['/admin/tours/rooms/:num'] = array('admin/ToursController', 'roomsCount');
$route['*']['/admin/tours/rooms2/:num2/:num3'] = array('admin/ToursController', 'roomsCount');
$route['*']['/admin/tours/rooms3/:num4/:num5'] = array('admin/ToursController', 'roomsCount');
$route['*']['/admin/tours/days/:salida/:retorno'] = array('admin/ToursController', 'getDaysNights');
$route['*']['/admin/tours/trips/arrival/:from/:to/:fecha/:type'] = array('admin/ToursController', 'trips');
$route['*']['/admin/tours/trips/departure/:from/:to/:fecha/:type'] = array('admin/ToursController', 'trips');
$route['*']['/admin/tours/consul/trips/poner'] = array('admin/ToursController', 'trips2');
$route['*']['/admin/tours/leader/ajax'] = array('admin/ToursController', 'ajaxcliente');
$route['*']['/admin/tours/leader/ajax2/:id/:id2'] = array('admin/ToursController', 'ajaxcliente2');
$route['*']['/admin/tours/exten/:id'] = array('admin/ToursController', 'exten');
$route['*']['/admin/tours/hotels/:cat/:inicio/:fin'] = array('admin/ToursController', 'hotelByCategory');
$route['*']['/admin/tours/parques/:park'] = array('admin/ToursController', 'parksSelection');


//crud de tours: tarifa trip
$route['*']['/admin/tours/tarifa-trip'] = array('admin/TourstripController', 'index');
$route['*']['/admin/tours/tarifa-trip/:type_rate'] = array('admin/TourstripController', 'index');
$route['*']['/admin/tours/tarifa-trip/:filtro/:texto/:type_rate/page/:pindex'] = array('admin/TourstripController', 'index');
$route['*']['/admin/tours/tarifa-trip/:filtro/:texto/:type_rate/:id_agency/page/:pindex'] = array('admin/TourstripController', 'index');
$route['*']['/admin/tours/tarifa-trip/add/:type_rate'] = array('admin/TourstripController', 'add');
$route['*']['/admin/tours/tarifa-trip/save'] = array('admin/TourstripController', 'save');
$route['*']['/admin/tours/tarifa-trip/edit/:pindex'] = array('admin/TourstripController', 'edit');
$route['*']['/admin/tours/tarifa-trip/delete'] = array('admin/TourstripController', 'delete');

//crud de tours: tarifa TRIP
/*
$route['*']['/admin/tours/tarifa-trip/:type_rate'] = array('admin/TourstripController', 'index');
$route['*']['/admin/tours/tarifa-trip/:filtro/:texto/:type_rate/page/:pindex'] = array('admin/TourstripController', 'index');
$route['*']['/admin/tours/tarifa-trip/add'] = array('admin/TourstripController', 'add');
$route['*']['/admin/tours/tarifa-trip/save'] = array('admin/TourstripController', 'save');
$route['*']['/admin/tours/tarifa-trip/edit/:pindex'] = array('admin/TourstripController', 'edit');
$route['*']['/admin/tours/tarifa-trip/delete'] = array('admin/TourstripController', 'delete');
*/
//crud de tours: tarifa by PLANE
$route['*']['/admin/tours/tarifa-plane'] = array('admin/ToursplaneController', 'index');
$route['*']['/admin/tours/tarifa-plane/:type_rate'] = array('admin/ToursplaneController', 'index');
$route['*']['/admin/tours/tarifa-plane/:filtro/:texto/:type_rate/page/:pindex'] = array('admin/ToursplaneController', 'index');
$route['*']['/admin/tours/tarifa-plane/:filtro/:texto/:type_rate/:id_agency/page/:pindex'] = array('admin/ToursplaneController', 'index');

$route['*']['/admin/tours/tarifa-plane/add/:type_rate'] = array('admin/ToursplaneController', 'add');
$route['*']['/admin/tours/tarifa-plane/save'] = array('admin/ToursplaneController', 'save');
$route['*']['/admin/tours/tarifa-plane/edit/:pindex'] = array('admin/ToursplaneController', 'edit');
$route['*']['/admin/tours/tarifa-plane/delete'] = array('admin/ToursplaneController', 'delete');

//crud de tours: tarifa by CAR
$route['*']['/admin/tours/tarifa-car'] = array('admin/TourscarController', 'index');
$route['*']['/admin/tours/tarifa-car/:type_rate'] = array('admin/TourscarController', 'index');
$route['*']['/admin/tours/tarifa-car/:filtro/:texto/:type_rate/page/:pindex'] = array('admin/TourscarController', 'index');
$route['*']['/admin/tours/tarifa-car/:filtro/:texto/:type_rate/:id_agency/page/:pindex'] = array('admin/TourscarController', 'index');

$route['*']['/admin/tours/tarifa-car/add/:type_rate'] = array('admin/TourscarController', 'add');
$route['*']['/admin/tours/tarifa-car/save'] = array('admin/TourscarController', 'save');
$route['*']['/admin/tours/tarifa-car/edit/:pindex'] = array('admin/TourscarController', 'edit');
$route['*']['/admin/tours/tarifa-car/delete'] = array('admin/TourscarController', 'delete');

//crud de tours: tarifa by VIP
$route['*']['/admin/tours/tarifa-vip'] = array('admin/ToursvipController', 'index');
$route['*']['/admin/tours/tarifa-vip/:type_rate'] = array('admin/ToursvipController', 'index');
$route['*']['/admin/tours/tarifa-vip/:filtro/:texto/:type_rate/page/:pindex'] = array('admin/ToursvipController', 'index');
$route['*']['/admin/tours/tarifa-vip/:filtro/:texto/:type_rate/:id_agency/page/:pindex'] = array('admin/ToursvipController', 'index');

$route['*']['/admin/tours/tarifa-vip/add/:type_rate'] = array('admin/ToursvipController', 'add');
$route['*']['/admin/tours/tarifa-vip/save'] = array('admin/ToursvipController', 'save');
$route['*']['/admin/tours/tarifa-vip/edit/:pindex'] = array('admin/ToursvipController', 'edit');
$route['*']['/admin/tours/tarifa-vip/delete'] = array('admin/ToursvipController', 'delete');

//crud de tours: Hoteles
$route['*']['/admin/tours/hotel'] = array('admin/HotelController', 'index');
$route['*']['/admin/tours/hotel/:filtro/:texto/page/:pindex'] = array('admin/HotelController', 'index');
$route['*']['/admin/tours/hotel/add'] = array('admin/HotelController', 'add');
$route['*']['/admin/tours/hotel/save'] = array('admin/HotelController', 'save');
$route['*']['/admin/tours/hotel/edit/:pindex'] = array('admin/HotelController', 'edit');
$route['*']['/admin/tours/hotel/delete'] = array('admin/HotelController', 'delete');

//crud de tours: Hoteles - categoria
$route['*']['/admin/tours/hotel-category'] = array('admin/HcategoriaController', 'index');
$route['*']['/admin/tours/hotel-category/:filtro/:texto/page/:pindex'] = array('admin/HcategoriaController', 'index');
$route['*']['/admin/tours/hotel-category/add'] = array('admin/HcategoriaController', 'add');
$route['*']['/admin/tours/hotel-category/save'] = array('admin/HcategoriaController', 'save');
$route['*']['/admin/tours/hotel-category/edit/:pindex'] = array('admin/HcategoriaController', 'edit');
$route['*']['/admin/tours/hotel-category/delete'] = array('admin/HcategoriaController', 'delete');

//crud de tours: Rates - room tarifas
$route['*']['/admin/tours/room-rates'] = array('admin/RatesroomController', 'index');
$route['*']['/admin/tours/room-rates/:type_rate'] = array('admin/RatesroomController', 'index');
$route['*']['/admin/tours/room-rates/:filtro/:texto/:type_rate/page/:pindex'] = array('admin/RatesroomController', 'index');
$route['*']['/admin/tours/room-rates/:filtro/:texto/:type_rate/:id_agency/page/:pindex'] = array('admin/RatesroomController', 'index');

$route['*']['/admin/tours/room-rates/add'] = array('admin/RatesroomController', 'add');
$route['*']['/admin/tours/room-rates/save'] = array('admin/RatesroomController', 'save');
$route['*']['/admin/tours/room-rates/edit/:pindex'] = array('admin/RatesroomController', 'edit');
$route['*']['/admin/tours/room-rates/delete'] = array('admin/RatesroomController', 'delete');

//crud de tours: Rates - block
$route['*']['/admin/tours/block-rates'] = array('admin/RatesblockController', 'index');
$route['*']['/admin/tours/block-rates/:filtro/:texto/page/:pindex'] = array('admin/RatesblockController', 'index');
$route['*']['/admin/tours/block-rates/add'] = array('admin/RatesblockController', 'add');
$route['*']['/admin/tours/block-rates/save'] = array('admin/RatesblockController', 'save');
$route['*']['/admin/tours/block-rates/edit/:pindex'] = array('admin/RatesblockController', 'edit');
$route['*']['/admin/tours/block-rates/delete'] = array('admin/RatesblockController', 'delete');

//crud de tours: parques
$route['*']['/admin/tours/parks'] = array('admin/ParqueController', 'index');
$route['*']['/admin/tours/parks/:filtro/:texto/page/:pindex'] = array('admin/ParqueController', 'index');
$route['*']['/admin/tours/parks/add'] = array('admin/ParqueController', 'add');
$route['*']['/admin/tours/parks/save'] = array('admin/ParqueController', 'save');
$route['*']['/admin/tours/parks/edit/:pindex'] = array('admin/ParqueController', 'edit');
$route['*']['/admin/tours/parks/delete'] = array('admin/ParqueController', 'delete');
$route['*']['/admin/tours/parks/list/:grupo'] = array('admin/ParqueController', 'parks');
$route['*']['/admin/tours/parks/stock'] = array('admin/ParqueController','add_stock');
$route['*']['/admin/tours/park/add_stock/:id/:amount'] = array('admin/ParqueController','update_stock');

//crud de tours: parques rates by group
$route['*']['/admin/tours/rates-group'] = array('admin/Rates_groupController', 'index');
$route['*']['/admin/tours/rates-group/:type_rate'] = array('admin/Rates_groupController', 'index');
$route['*']['/admin/tours/rates-group/:filtro/:texto/:type_rate/page/:pindex'] = array('admin/Rates_groupController', 'index');
$route['*']['/admin/tours/rates-group/:filtro/:texto/:type_rate/:id_agency/page/:pindex'] = array('admin/Rates_groupController', 'index');

$route['*']['/admin/tours/rates-group/add/:type_rate'] = array('admin/Rates_groupController', 'add');
$route['*']['/admin/tours/rates-group/save'] = array('admin/Rates_groupController', 'save');
$route['*']['/admin/tours/rates-group/edit/:pindex'] = array('admin/Rates_groupController', 'edit');
$route['*']['/admin/tours/rates-group/delete'] = array('admin/Rates_groupController', 'delete');

//crud de tours: parques rates VIP by group
$route['*']['/admin/tours/rates-vip-group'] = array('admin/Rates_vip_groupController', 'index');
$route['*']['/admin/tours/rates-vip-group/:type_rate'] = array('admin/Rates_vip_groupController', 'index');
$route['*']['/admin/tours/rates-vip-group/:filtro/:texto/:type_rate/page/:pindex'] = array('admin/Rates_vip_groupController', 'index');
$route['*']['/admin/tours/rates-vip-group/:filtro/:texto/:type_rate/:id_agency/page/:pindex'] = array('admin/Rates_vip_groupController', 'index');

$route['*']['/admin/tours/rates-vip-group/add/:type_rate'] = array('admin/Rates_vip_groupController', 'add');
$route['*']['/admin/tours/rates-vip-group/save'] = array('admin/Rates_vip_groupController', 'save');
$route['*']['/admin/tours/rates-vip-group/edit/:pindex'] = array('admin/Rates_vip_groupController', 'edit');
$route['*']['/admin/tours/rates-vip-group/delete'] = array('admin/Rates_vip_groupController', 'delete');


//crud de tours: parques Adminsion Rate
$route['*']['/admin/tours/admision-rate/:type_rate'] = array('admin/Admin_ratesController', 'index');
$route['*']['/admin/tours/admision-rate/:type_rate/:filtro/:texto/page/:pindex'] = array('admin/Admin_ratesController', 'index');
$route['*']['/admin/tours/admision-rate/add/:type_rate'] = array('admin/Admin_ratesController', 'add');
$route['*']['/admin/tours/admision-rate/save'] = array('admin/Admin_ratesController', 'save');
$route['*']['/admin/tours/admision-rate/edit/:pindex'] = array('admin/Admin_ratesController', 'edit');
$route['*']['/admin/tours/admision-rate/delete'] = array('admin/Admin_ratesController', 'delete');

//crud de tours: parques Cost
$route['*']['/admin/tours/admision-cost'] = array('admin/Admin_ratesController','list_admincost');
$route['*']['/admin/tours/admision-cost/:filtro/:texto/page/:pindex'] = array('admin/Admin_ratesController', 'list_admincost');
$route['*']['/admin/tours/admision-cost/add'] = array('admin/Admin_ratesController','addadmincost');
$route['*']['/admin/tours/admision-cost/save'] = array('admin/Admin_ratesController','saveadmincost');
$route['*']['/admin/tours/admision-cost/edit/:id'] = array('admin/Admin_ratesController','editadmincost');
$route['*']['/admin/tours/admision-cost/delete/:id'] = array('admin/Admin_ratesController','deleteadmincost');
//crud de tours: parques group
$route['*']['/admin/tours/group-parks'] = array('admin/Group_parksController', 'index');
$route['*']['/admin/tours/group-parks/:filtro/:texto/page/:pindex'] = array('admin/Group_parksController', 'index');
$route['*']['/admin/tours/group-parks/add'] = array('admin/Group_parksController', 'add');
$route['*']['/admin/tours/group-parks/save'] = array('admin/Group_parksController', 'save');
$route['*']['/admin/tours/group-parks/edit/:pindex'] = array('admin/Group_parksController', 'edit');
$route['*']['/admin/tours/group-parks/delete'] = array('admin/Group_parksController', 'delete');

//crud de tours: parques vip rates
$route['*']['/admin/tours/parks-vip'] = array('admin/Parks_vip_ratesController', 'index');
$route['*']['/admin/tours/parks-vip/:filtro/:texto/page/:pindex'] = array('admin/Parks_vip_ratesController', 'index');
$route['*']['/admin/tours/parks-vip/add'] = array('admin/Parks_vip_ratesController', 'add');
$route['*']['/admin/tours/parks-vip/save'] = array('admin/Parks_vip_ratesController', 'save');
$route['*']['/admin/tours/parks-vip/edit/:pindex'] = array('admin/Parks_vip_ratesController', 'edit');
$route['*']['/admin/tours/parks-vip/delete'] = array('admin/Parks_vip_ratesController', 'delete');


//One day tour rates
$route['*']['/admin/onedaytour/rates/:type_rate'] = array('admin/OnedaytourController', 'index');
$route['*']['/admin/onedaytour/rates/add/:type_rate'] = array('admin/OnedaytourController', 'add');
$route['*']['/admin/onedaytour/rates/save'] = array('admin/OnedaytourController', 'save');
$route['*']['/admin/onedaytour/rates/edit/:pindex'] = array('admin/OnedaytourController', 'edit');
$route['*']['/admin/onedaytour/rates/delete'] = array('admin/OnedaytourController', 'delete');

//crud de rewards
$route['*']['/admin/rewards'] = array('admin/RewardsController', 'index');
$route['*']['/admin/rewards/:filtro/:texto/page/:pindex'] = array('admin/RewardsController', 'index');
$route['*']['/admin/rewards/add'] = array('admin/RewardsController', 'add');
$route['*']['/admin/rewards/save'] = array('admin/RewardsController', 'save');
$route['*']['/admin/rewards/edit/:pindex'] = array('admin/RewardsController', 'edit');
$route['*']['/admin/rewards/delete'] = array('admin/RewardsController', 'delete');

//crud de bonos
$route['*']['/admin/bonos'] = array('admin/BonosController', 'index');
$route['*']['/admin/bonos:filtro/:texto/page/:pindex'] = array('admin/BonosController', 'index');
$route['*']['/admin/bonos/add'] = array('admin/BonosController', 'add');
$route['*']['/admin/bonos/save'] = array('admin/BonosController', 'save');
$route['*']['/admin/bonos/edit/:pindex'] = array('admin/BonosController', 'edit');
$route['*']['/admin/bonos/delete'] = array('admin/BonosController', 'delete');
$route['*']['/admin/bonos/autocomplete'] = array('admin/BonosController', 'autoComplete');

//crud de reglas de bonos
$route['*']['/admin/BonosRules'] = array('admin/BonosRulesController', 'index');
$route['*']['/admin/BonosRules:filtro/:texto/page/:pindex'] = array('admin/BonosRulesController', 'index');
$route['*']['/admin/BonosRules/add'] = array('admin/BonosRulesController', 'add');
$route['*']['/admin/BonosRules/save'] = array('admin/BonosRulesController', 'save');
$route['*']['/admin/BonosRules/edit/:pindex'] = array('admin/BonosRulesController', 'edit');
$route['*']['/admin/BonosRules/delete'] = array('admin/BonosRulesController', 'delete');

//mysuperclub
$route['*']['/mysuperclub'] = array('MySuperClubController', 'index');
$route['*']['/mysuperclub/:error'] = array('MySuperClubController', 'user');
$route['*']['/mysuperclub/user'] = array('MySuperClubController', 'user');
$route['*']['/mysuperclub/singup'] = array('MySuperClubController', 'singup');
$route['*']['/mysuperclub/reserve'] = array('MySuperClubController', 'reserve');
$route['*']['/mysuperclub/save'] = array('MySuperClubController', 'save');
$route['*']['/mysuperclub/close'] = array('MySuperClubController', 'close');
$route['*']['/mysuperclub/getRewards/:left_points'] = array('MySuperClubController', 'getRewardsByPoints');
$route['*']['/mysuperclub/getReward'] = array('MySuperClubController', 'getRewardByRerserves');
$route['*']['/mysuperclub/getReward/:num'] = array('MySuperClubController', 'getRewardsAmmount');
$route['*']['/mysuperclub/getBono'] = array('MySuperClubController', 'autoBono');
$route['*']['/mysuperclub/exchanged'] = array('MySuperClubController', 'getExchangedRewards');
$route['*']['/mysuperclub/mybono/:bono'] = array('MySuperClubController', 'getBono');
$route['*']['/mysuperclub/discount/:bono'] = array('MySuperClubController', 'discountBono');

//tours load questions
$route['*']['/tours/1'] = array('ToursControllerWeb', 'tours_one');
$route['*']['/tours/2'] = array('ToursControllerWeb', 'tours_two');
$route['*']['/tours/3'] = array('ToursControllerWeb', 'c');
$route['*']['/tours/4'] = array('ToursControllerWeb', 'tours_four');
$route['*']['/tours/5'] = array('ToursControllerWeb', 'onedaytour_one');// one  day tour
$route['*']['/tours/6'] = array('ToursControllerWeb', 'skiphotel');// MULTI  day tour
$route['*']['/tours/paymult'] = array('ToursControllerWeb', 'pagomulti');// MULTI  day tour

$route['*']['/tours/usermullog2'] = array('ToursControllerWeb', 'logUser_multidaytour');
$route['*']['/tours/autentication/loginmulti'] = array('ToursControllerWeb', 'loginmulti');
$route['*']['/tours/autentication/guestmulti'] = array('ToursControllerWeb', 'guestmulti');
$route['*']['/tours/autentication/shopuser_invmulti'] = array('ToursControllerWeb', 'shopuser_invmulti');
$route['*']['/tours/signupmulti'] = array('ToursControllerWeb', 'signupmulti');
$route['*']['/tours/signup/savemulti'] = array('ToursControllerWeb', 'savesignupmulti');
$route['*']['/identification/login'] = array('ToursControllerWeb', 'loginiden');
$route['*']['/tours/signupmulti/slope'] = array('ToursControllerWeb', 'slopetours');
$route['*']['/tours/signupone/slope'] = array('ToursControllerWeb', 'slopetoursone');



$route['*']['/tours/8'] = array('ToursControllerWeb', 'tours_six');

$route['*']['/tours/step-one'] = array('ToursControllerWeb', 'step_one');
$route['*']['/step-two'] = array('ToursControllerWeb', 'step_two');
$route['*']['/step-three'] = array('ToursControllerWeb', 'step_three');
$route['*']['/tours/confirmation'] = array('ToursControllerWeb', 'confirma');

$route['*']['/tours/autentication'] = array('ToursControllerWeb', 'autentication');
$route['*']['/tours/signup'] = array('ToursControllerWeb', 'signup');
$route['*']['/tours/signup/save'] = array('ToursControllerWeb', 'savesignup');
$route['*']['/tours/autentication/user'] = array('ToursControllerWeb', 'logueo');
$route['*']['/tours/save'] = array('ToursControllerWeb', 'save');
$route['*']['/tours/slope'] = array('ToursControllerWeb', 'slope');
$route['*']['/tours/reportar/:valor'] = array('ToursControllerWeb', 'reportar');
$route['*']['/tours/quotation'] = array('ToursControllerWeb', 'quotation');
$route['*']['/tours/autentication/guest'] = array('ToursControllerWeb', 'guest');
$route['*']['/tours/autentication/shopuser_inv'] = array('ToursControllerWeb', 'shopuser_inv');

$route['*']['/tours/Area/:id'] = array('ToursControllerWeb', 'idArea');
$route['*']['/tours/question/:id/:id2/:corte'] = array('ToursControllerWeb', 'question');
$route['*']['/tours/multi/insertaruso1/:trip1/:fechatrip1/:totalpax/:tipo'] = array('ToursControllerWeb', 'insertaruso');
$route['*']['/tours/multi/insertaruso2/:trip2/:fechatrip2/:totalpax/:tipo'] = array('ToursControllerWeb', 'insertaruso');

$route['*']['/quitarCupoMultiday/:iden/:tipo'] = array('ToursControllerWeb', 'quitarmultiDay');
//mandarPax/tour   tours/getpriceh/
$route['*']['/mandarPax/tour/:adult/:child/:fecha1/:trip1'] = array('ToursControllerWeb', 'mandarPaxTour');
$route['*']['/mandarPax/tourRetorno/:adult/:child/:fecha1/:trip1'] = array('ToursControllerWeb', 'mandarPaxTourRetorno');

$route['*']['/tours/question2/:id/:id2/:id3/:id4/:corte/:paxs/:idarea'] = array('ToursControllerWeb', 'question');
$route['*']['/tours/question3/:id'] = array('ToursControllerWeb', 'question2');
$route['*']['/tours/question4/:id'] = array('ToursControllerWeb', 'question3');
$route['*']['/tours/question5/:id2/:id22'] = array('ToursControllerWeb', 'question3');
$route['*']['/tours/question6/:id3/:id33'] = array('ToursControllerWeb', 'question3');
$route['*']['/tours/question7/:id/:resp'] = array('ToursControllerWeb', 'ajaxparks');
$route['*']['/tours/getpriceh/:id'] = array('ToursControllerWeb', 'getpriceh');
$route['*']['/tours/hoteldisp/:id'] = array('ToursControllerWeb', 'hoteldisp');

$route['*']['/tours/filter3'] = array('ToursControllerWeb', 'filter3');

$route['*']['/tours/question8/:ides/:resp'] = array('ToursControllerWeb', 'ajaxparks');
$route['*']['/tours/question9/:resp'] = array('ToursControllerWeb', 'ques');
$route['*']['/tours/question10/:resp'] = array('ToursControllerWeb', 'ques2');
$route['*']['/tours/question11/:id'] = array('ToursControllerWeb', 'platinum');
$route['*']['/tours/question12/:fecharri/:fechadepar'] = array('ToursControllerWeb', 'diasnoches');
$route['*']['/tours/question13/:fecha/:tipo'] = array('ToursControllerWeb', 'arrival');
$route['*']['/tours/question14/:id'] = array('ToursControllerWeb', 'area');/**nueva */
$route['*']['/tours/question14/:id/:trip_no'] = array('ToursControllerWeb', 'area');
$route['*']['/tours/question15/:id'] = array('ToursControllerWeb', 'exten');
$route['*']['/tours/question15/:id/:num'] = array('ToursControllerWeb', 'exten');
$route['*']['/tours/question16'] = array('ToursControllerWeb', 'hotelajax');
$route['*']['/tours/question17/:id'] = array('ToursControllerWeb', 'buffet');
$route['*']['/tours/question18/:id/:id2/:id3/:id4/:corte/:paxs/:idarea'] = array('ToursControllerWeb', 'selare');
$route['*']['/tours/question19/:trip/:id2/:idarea'] = array('ToursControllerWeb', 'selpicdro');
$route['*']['/tours/validarFecha/:fecha/:type'] = array('ToursControllerWeb', 'validarFechaTours');

//rutas para 1 day tour (tour de un dia). "  quitarCupoOneDay/  revisarPuestos"
$route['*']['/revisar/puesto/:iden'] = array('ToursControllerWeb', 'revisarPuestos');
$route['*']['/quitarCupoOneDay/:iden'] = array('ToursControllerWeb', 'quitarOneDay');

//$route['*']['/1-day-tour'] = array('ToursControllerWeb', 'onedaytour');
//$route['*']['/'] = array('MainController', 'index');
$route['*']['/1-day-tour'] = array('ToursControllerWeb', 'onedaytour');

$route['*']['/onedaytour/:sentido/:idArea/:fechaS/:totalpax/:iden'] = array('ToursControllerWeb', 'selectTrip');
$route['*']['/tours/onedaytour/:sentido/:idArea/:fechaS/:opcionPickup'] = array('ToursControllerWeb', 'selectTrip');
$route['*']['/tours/onedaytour-pickup/:id/:idArea'] = array('ToursControllerWeb', 'selectArea');
$route['*']['/onedaytour-park'] = array('ToursControllerWeb', 'onedaytour_two');
$route['*']['/onedaytour-park/:id/:resp'] = array('ToursControllerWeb', 'ajaxparks_onedaytour');
$route['*']['/onedaytour-park2/:ides/:resp'] = array('ToursControllerWeb', 'ajaxparks_onedaytour');
$route['*']['/tours/onedaytour-tiquete/:resp'] = array('ToursControllerWeb', 'ques_agregarTiquete');
$route['*']['/tours/onedaytour_step_three'] = array('ToursControllerWeb', 'onedaytour_step_three');
$route['*']['/tours/18'] = array('ToursControllerWeb', 'onedaytour_four');
$route['*']['/confirmation_onedaytour'] = array('ToursControllerWeb', 'onedaytour_confirma');
$route['*']['/tours/correo_onedaytour'] = array('ToursControllerWeb', 'correo_onedaytour');
$route['*']['/tours/autentication/login'] = array('ToursControllerWeb', 'login');
// $route['*']['/tours/autentication/signup'] = array('ToursControllerWeb', 'login');
// $route['*']['/tours/autentication/login'] = array('ToursControllerWeb', 'login');
$route['*']['/tours/approved'] = array('ToursControllerWeb', 'aprovado');

//rutas para one day tour operadores



//rutas para admin agencia credit
$route['*']['/admin/agency/credit'] = array('admin/AcreditController', 'index');
$route['*']['/admin/agency/credit/:filtro/:texto/page/:pindex'] = array('admin/AcreditController', 'index');
$route['*']['/admin/agency/credit/add'] = array('admin/AcreditController', 'add');
$route['*']['/admin/agency/credit/save'] = array('admin/AcreditController', 'save');
$route['*']['/admin/agency/credit/edit/:pindex'] = array('admin/AcreditController', 'edit');
$route['*']['/admin/agency/credit/delete'] = array('admin/AcreditController', 'delete');

//rutas para admin agencia debit
$route['*']['/admin/agency/debit'] = array('admin/AdebitController', 'index');
$route['*']['/admin/agency/debit/:filtro/:texto/page/:pindex'] = array('admin/AdebitController', 'index');
$route['*']['/admin/agency/debit/add'] = array('admin/AdebitController', 'add');
$route['*']['/admin/agency/debit/save'] = array('admin/AdebitController', 'save');
$route['*']['/admin/agency/debit/edit/:pindex'] = array('admin/AdebitController', 'edit');
$route['*']['/admin/agency/debit/delete'] = array('admin/AdebitController', 'delete');


//rutas para admin agencia
$route['*']['/admin/agency'] = array('admin/AgencyController', 'index');
$route['*']['/admin/agency/:filtro/:texto/page/:pindex'] = array('admin/AgencyController', 'index');
$route['*']['/admin/agency/add'] = array('admin/AgencyController', 'add');
$route['*']['/admin/agency/save'] = array('admin/AgencyController', 'save');
$route['*']['/admin/agency/edit/:pindex'] = array('admin/AgencyController', 'edit');
$route['*']['/admin/agency/delete'] = array('admin/AgencyController', 'delete');
$route['*']['/admin/agency/ajax'] = array('admin/AgencyController', 'code');

//rutas de busquedas para agencias
$route['*']['/admin/searchagency'] = array('admin/AgencyController','searchagency');


$route['*']['/admin/vistas'] = array('admin/AgencyController', 'vistas');

//rutas para agencia users
$route['*']['/admin/agency/users'] = array('admin/UseraController', 'index');
$route['*']['/admin/agency/users/:filtro/:texto/page/:pindex'] = array('admin/UseraController', 'index');
$route['*']['/admin/agency/users/add'] = array('admin/UseraController', 'add');
$route['*']['/admin/agency/users/save'] = array('admin/UseraController', 'save');
$route['*']['/admin/agency/users/edit/:pindex'] = array('admin/UseraController', 'edit');
$route['*']['/admin/agency/users/delete'] = array('admin/UseraController', 'delete');

//rutas para agencia table comision
$route['*']['/admin/agency/comision'] = array('admin/ComisionController', 'index');
$route['*']['/admin/agency/comision/:filtro/:texto/page/:pindex'] = array('admin/ComisionController', 'index');
$route['*']['/admin/agency/comision/add'] = array('admin/ComisionController', 'add');
$route['*']['/admin/agency/comision/save'] = array('admin/ComisionController', 'save');
$route['*']['/admin/agency/comision/edit/:pindex'] = array('admin/ComisionController', 'edit');
$route['*']['/admin/agency/comision/delete'] = array('admin/ComisionController', 'delete');



//agencia web
$route['*']['/agency'] = array('AgenciaController', 'index');

$route['*']['/agency/mytours'] = array('AgenciaController', 'mytours');
$route['*']['/agency/mytours/:filtro/:texto/page/:pindex'] = array('AgenciaController', 'mytours');

$route['*']['/agency/mytours2'] = array('AgenciaController', 'mytours2');
$route['*']['/agency/mytours2/:filtro/:texto/page/:pindex'] = array('AgenciaController', 'mytours2');

$route['*']['/agency/transport'] = array('AgenciaController', 'mytransportations');
$route['*']['/agency/transport/:filtro/:texto/page/:pindex'] = array('AgenciaController', 'mytransportations');

$route['*']['/agency/myadmin'] = array('AgenciaController', 'myadmin');
$route['*']['/agency/myprofile'] = array('AgenciaController', 'myprofile');

$route['*']['/agency/:filtro/:texto/page/:pindex'] = array('AgenciaController', 'index');
$route['*']['/agency/user'] = array('AgenciaController', 'user');
$route['*']['/agency/logout'] = array('AgenciaController', 'logout');
$route['*']['/agency/profile'] = array('AgenciaController', 'profile');
$route['*']['/agency/ajax'] = array('AgenciaController', 'airport');
$route['*']['/agency/totalizar'] = array('AgenciaController', 'totalizar');
$route['*']['/agency/iscredit'] = array('AgenciaController', 'iscredit');
$route['*']['/agency/ajaxs/:id'] = array('AgenciaController', 'formato');
$route['*']['/agency/ajaxsMdTours/:id'] = array('AgenciaController', 'formatoMDTours');
$route['*']['/agency/ajaxsOneTours/:id'] = array('AgenciaController', 'formatoOneTours');

//ruta para OfertasController
$route['*']['/admin/ofertas'] = array('admin/OfertasController', 'index');
$route['*']['/admin/ofertas/:filtro/:texto/page/:pindex'] = array('admin/OfertasController', 'index');
$route['*']['/admin/ofertas/add'] = array('admin/OfertasController', 'add');
$route['*']['/admin/ofertas/save'] = array('admin/OfertasController', 'save');
$route['*']['/admin/ofertas/edit/:pindex'] = array('admin/OfertasController', 'edit');
$route['*']['/admin/ofertas/delete'] = array('admin/OfertasController', 'delete');




//ruta para ReservasController
$route['*']['/admin/reservas'] = array('admin/ReservasController', 'index');
$route['*']['/admin/reservas/:filtro/:texto/page/:pindex'] = array('admin/ReservasController', 'index');
$route['*']['/admin/reservas_quotes'] = array('admin/ReservasController', 'quotes');
$route['*']['/admin/reservas_quotes/:filtro/:texto/page/:pindex'] = array('admin/ReservasController', 'quotes');
$route['*']['/admin/reservas/add'] = array('admin/ReservasController', 'add');
$route['*']['/admin/reservas/add/trip/:id/:tipo'] = array('admin/ReservasController', 'SelectTrip');
$route['*']['/admin/reservas/load'] = array('admin/ReservasController', 'loadAreas');
$route['*']['/admin/reservas/pago'] = array('admin/ReservasController', 'pagoWeb');
$route['*']['/transaction/admin/reserva/pago'] = array('admin/ReservasController', 'estado_pago');
$route['*']['/transaction/admin/reserva/approval'] = array('admin/ReservasController', 'response_aproval');
$route['*']['/transaction/admin/reserva/decline'] = array('admin/ReservasController', 'response_decline');
$route['*']['/admin/reservas/save'] = array('admin/ReservasController', 'saveReserve');
$route['*']['/admin/reservas/save-edit-reserve'] = array('admin/ReservasController', 'save_editReserve');
$route['*']['/admin/reservas/consultatrip'] = array('admin/ReservasController', 'consultatrip');
$route['*']['/admin/reservas/edit/:pindex'] = array('admin/ReservasController', 'editReserve');
$route['*']['/admin/reservas/edit/:pindex/:url'] = array('admin/ReservasController', 'editReserve');
$route['*']['/admin/reservas/rastro_detalles/:id'] = array('admin/ReservasController', 'detalles_rastro');
$route['*']['/admin/reservas/estado_trips'] = array('admin/ReservasController', 'tripsEstados');
$route['*']['/admin/reservas/ocuparPuesto/:trip/:tipo/:fecha/:cantidad/:opcion'] = array('admin/ReservasController', 'ocuparPuesto');
$route['*']['/admin/reservas/ocuparPuestoUsuario/:opcion'] = array('admin/ReservasController', 'ocuparPuestoUsuario');



$route['*']['/booking/pickup-dropoff/autentication/pago'] = array('MainController', 'pago');
$route['*']['/booking/pickup-dropoff/autentication/busquedaPuesto'] = array('MainController', 'puesto');

$route['*']['/ajaxfrom'] = array('MainController', 'ajaxfrom');
$route['*']['/ajaxto'] = array('MainController', 'ajaxto');
#ruta del E-Ticket de prueba
//$route['*']['/e'] = array('MainController', 'loading');

//$route['*']['/booking/pickup-dropoff/autentication/pagos'] = array('MainController', 'pagos');
$route['*']['/booking/pickup-dropoff/autentication/invitado'] = array('MainController', 'invitadoPago');
$route['*']['/booking/pickup-dropoff/autentication/invitado/resumen'] = array('MainController', 'resumen');
$route['*']['/booking/pickup-dropoff/autentication/pago/agency'] = array('MainController', 'pagoAgency');
//contact
$route['*']['/contact'] = array('MainController', 'contacto');

// rutas para Schedule
$route['*']['/admin/schedule'] = array('admin/ScheduleController', 'index');
$route['*']['/admin/schedule/add'] = array('admin/ScheduleController', 'add');
$route['*']['/admin/schedule/save'] = array('admin/ScheduleController', 'save');
$route['*']['/admin/schedule/change/:pindex'] = array('admin/ScheduleController', 'change');
$route['*']['/admin/schedule/change2'] = array('admin/ScheduleController', 'change2');
$route['*']['/admin/schedule/update'] = array('admin/ScheduleController', 'update');
$route['*']['/admin/schedule/update2'] = array('admin/ScheduleController', 'update2');
$route['*']['/admin/schedule/:filtro/:texto/page/:pindex'] = array('admin/ScheduleController', 'index');

// rutas para RatesController
$route['*']['/admin/rates'] = array('admin/RatesController', 'index');
$route['*']['/admin/rates/save'] = array('admin/RatesController', 'save');

//pagos reserva
$route['*']['/proccess'] = array('MainController', 'proceso');
//$route['*']['/transaction/approved'] = array('MainController', 'aprovado');
$route['*']['/transaction/approved/:cargosf/:clientef'] = array('MainController', 'aprovado');
$route['*']['/transaction/approval'] = array('MainController', 'load');
$route['*']['/transaction/decline'] = array('MainController', 'decline');
$route['*']['/transaction/declination'] = array('MainController', 'decline2');



// rutas para MainController
$route['*']['/calculando/precio/:adult/:child'] = array('MainController', 'calcularPrecio');

$route['*']['/'] = array('MainController', 'index');
$route['*']['/questions'] = array('MainController', 'areyou');
$route['*']['/questionsMobile'] = array('MainController', 'floridaResident');

$route['*']['/booking'] = array('MainController', 'booking');
$route['*']['/bookingMobile'] = array('MainController', 'bookingMobil');
$route['*']['/booking/pickup-dropoff'] = array('MainController', 'pickupDropoff');
$route['*']['/booking/pickup-dropoffMobil'] = array('MainController', 'pickupDropoffMobil');
$route['*']['/booking/pickup-dropoff/autentication'] = array('MainController', 'logueo');
$route['*']['/booking/pickup-dropoff/autentication/user'] = array('MainController', 'loginuser');
$route['*']['/booking/pickup-dropoff/autentication/login'] = array('MainController', 'loginuser');
$route['*']['/booking/pickup-dropoff/autentication/logout'] = array('MainController', 'logout');
$route['*']['/booking/pickup-dropoff/autentication/signup'] = array('MainController', 'signup');
$route['*']['/booking/pickup-dropoff/autentication/signup/:filtro/:texto/page/:pindex'] = array('MainController', 'signup');
$route['*']['/booking/pickup-dropoff/autentication/signup/save'] = array('MainController', 'save');


$route['*']['/informacionTrip/:from_name/:to_name'] = array('MainController', 'tripInfo');



$route['*']['/booking/pickup-dropoff/autentication/signup/slope'] = array('MainController', 'slope2');
#Pasar como invitado
$route['*']['/booking/pickup-dropoff/autentication/guest'] = array('MainController', 'guest');
$route['*']['/cargar/guest'] = array('MainController', 'cargarGuest');
$route['*']['/booking/pickup-dropoff/autentication/signup/guestcard'] = array('MainController', 'guestcard');
//booking/pickup-dropoff/autentication/signup/saveGuest
$route['*']['/booking/pickup-dropoff/autentication/signup/saveGuest'] = array('MainController', 'saveGuest');
//quitarCupo  editarCupo
$route['*']['/quitarCupo'] = array('MainController', 'quitarPax');
$route['*']['/editarCupo'] = array('MainController', 'editarPax');
$route['*']['/booking/pickup-dropoff/autentication/shopuser_agency'] = array('MainController', 'confir');
$route['*']['/booking/pickup-dropoff/autentication/reserva'] = array('MainController', 'reserve');
$route['*']['/booking/pickup-dropoff/autentication/reserva/load'] = array('MainController', 'load');
$route['*']['/booking2/pickup-dropoff/autentication/reserva/load/:cargoJson/:clienteJson'] = array('MainController', 'load');
$route['*']['/booking/pickup-dropoff/autentication/reservations'] = array('MainController', 'Myreservas');
$route['*']['/booking/pickup-dropoff/autentication/profile'] = array('MainController', 'profile');
$route['*']['/booking/pickup-dropoff/autentication/profile/update'] = array('MainController', 'update');
$route['*']['/load/:from'] = array('MainController', 'getAreas');
$route['*']['/load/:from/:to'] = array('MainController', 'getAreasLoad');
$route['*']['/exten_to_tot_of_from/:from'] = array('MainController', 'exten_to_tot_of_from');
$route['*']['/area_to_tot_of_from/:from'] = array('MainController', 'area_to_tot_of_from');
$route['*']['/load2/:country'] = array('MainController', 'pais');
$route['*']['/load3/:variable'] = array('MainController', 'r');
$route['*']['/load4/:otro'] = array('MainController', 'maill');
$route['*']['/load5/:id'] = array('MainController', 'valid');

//$route['*']['/load2/:response1:response2'] = array('MainController', 'getAreas');
$route['*']['/error'] = array('ErrorController', 'index');
$route['*']['/booking/pickup-dropoff/autentication/recover'] = array('MainController', 'recover');
$route['*']['/booking/pickup-dropoff/autentication/showproute/load'] = array('MainController', 'tipoclient');
$route['*']['/booking/pickup-dropoff/autentication/showproute/email'] = array('MainController', 'load');

/* rutas page */
$route['*']['/fleet-terminal-supertours'] = array('MainController', 'fleet');
$route['*']['/localizador-bus-stop'] = array('MainController', 'localizar');
$route['*']['/goal-supertours-of-orlando'] = array('MainController', 'goal');
$route['*']['/free-onboard'] = array('MainController', 'free');

#ruta para la localizacion
$route['*']['/localizador/nuevo'] = array('MainController', 'AllBuses');


$route['*']['/envio'] = array('MainController', 'sinrecarga');
$route['*']['/charters-miami-orlandol'] = array('MainController', 'charters');
$route['*']['/contact-us-supertours'] = array('MainController', 'contact');
$route['*']['/tickets-policy-supertours'] = array('MainController', 'tickets');
//$route['*']['/1-day-tour'] = array('MainController', 'daytour');
$route['*']['/hotel-month'] = array('MainController', 'hotel');
$route['*']['/multi-days-tours'] = array('MainController', 'multitours');
$route['*']['/destinations-florida'] = array('MainController', 'destinations');
$route['*']['/baggage'] = array('MainController', 'baggage');
$route['*']['/terms-conditions-tours'] = array('MainController', 'conditionsT');
$route['*']['/cancellation-policies'] = array('MainController', 'policies');
$route['*']['/faq'] = array('MainController', 'faq');
/* Agency */
$route['*']['/agency/signup'] = array('MainController', 'Asinup');
$route['*']['/agency/signup/save'] = array('MainController', 'Asave');
$route['*']['/agency/signup/slope'] = array('MainController', 'slope');
$route['*']['/agency/register'] = array('AgenciaController', 'register');
/* tours user page 1 */
$route['*']['/tours'] = array('ToursControllerWeb', 'index'); /*PARA ACTIVAR TOUR*/
// $route['*']['/tours/userlog'] = array('ToursControllerWeb', 'logUser');

$route['*']['/tours/eticket'] = array('ToursControllerWeb', 'Eticket');

$route['*']['/tours/userlog2'] = array('ToursControllerWeb', 'logUser_onedaytour');
$route['*']['/tours/save'] = array('ToursControllerWeb', 'save');

/*valida el email que no este repetido*/
$route['*']['/tours/username/:username'] = array('ToursControllerWeb', 'validUsername');

/*enviar a pago de tours*/
$route['*']['/tours/pago'] = array('ToursControllerWeb', 'pago_t');
$route['*']['/tours/pago2'] = array('ToursControllerWeb', 'pago_tm');
$route['*']['/tours/transaction/approval'] = array('ToursControllerWeb', 'transaction_approval');
$route['*']['/tours/transaction/decline'] = array('ToursControllerWeb', 'transaction_decline');
/*response_approval : respuesta de aprovacion o satisfaccion si se registra la reserva pagada de tours */
$route['*']['/tours/approval/response'] = array('ToursControllerWeb', 'response_approval');
$route['*']['/tours/approval/response2'] = array('ToursControllerWeb', 'response_approval_onedaytour');
$route['*']['/close/session'] = array('ToursControllerWeb', 'close_session');
/* Onedaytour Admin */
$route['*']['/admin/onedaytour/add'] = array('admin/OnedaytourController','add_oneday_tour');
$route['*']['/onedaytour/:childs/:adults/:id_park/:id_agency/:fecha'] = array('admin/OnedaytourController','getPriceParks'); //obtener los precios de los parques onedaytour
$route['*']['/admin/onedaytour/:filtro/:texto/page/:pindex'] = array('admin/OnedaytourController', 'list_oneday'); //paginacion
$route['*']['/admin/oneday/getcosttransf/:type_rate/:fecha'] = array('admin/OnedaytourController','getCosto'); //obtiene el costo x niño y adulto del transfer de onedaytour
$route['*']['/admin/oneday/getcosttransfext/:ext/:index'] = array ('admin/OnedaytourController','getCostoExt'); //obtener el precio de la extension
$route['*']['/onedaytour/save'] = array('admin/OnedaytourController','save_oneday');
$route['*']['/onedaytour/save_edited'] = array('admin/OnedaytourController','save_edited_oneday');
$route['*']['/admin/onetours/loaddatos'] = array('admin/OnedaytourController','loadDatos');
$route['*']['/iscomi/:id_agency'] = array('admin/OnedaytourController'.'iscomi');
$route['*']['/admin/onedaytour'] = array('admin/OnedaytourController','list_oneday');
$route['*']['/admin/onedaytour/quoted'] = array('admin/OnedaytourController','list_quoted');
$route['*']['/admin/onedaytour/edit/:id'] = array('admin/OnedaytourController','edit_oneday');
$route['*']['/admin/oneday/is_complete/:id'] = array('admin/OnedaytourController','complete_client');
$route['*']['/transaction/admin/onedaytours/payment'] = array('admin/OnedaytourController','estado_pago');
$route['*']['/transaction/admin/onedaytours/approval'] = array('admin/OnedaytourController','approval_payment');
$route['*']['/transaction/admin/onedaytours/decline'] = array('admin/OnedaytourController', 'transaction_decline');
$route['*']['/admin/onedaytour/edit/rastro/:id'] = array('admin/OnedaytourController', 'detalles_rastro');
/*CRUD de usuarios*/
$route['*']['/admin/users'] = array('admin/UsersController','index');
$route['*']['/admin/users/add'] = array('admin/UsersController','addUser');
$route['*']['/admin/users/edit/:id'] = array('admin/UsersController','editUser');
$route['*']['/admin/users/delete/:id'] = array('admin/UsersController','deleteUser');
$route['*']['/admin/users/existuser/:username'] = array('admin/UsersController','existuserajax');
$route['*']['/admin/users/existemail/:email'] = array('admin/UsersController','existemailajax');
$route['*']['/admin/users/save'] = array('admin/UsersController','saveUser');
$route['*']['/admin/users/save_edited'] = array('admin/UsersController','saveUser_edited');
/* Trafico */
//$route['*']['/admin/traffic/update_traffic'] = array('admin/TrafficController', 'update_traffic');
//$route['*']['/admin/traffic/create_traffic'] = array('admin/TrafficController', 'create_traffic');
//$route['*']['/admin/traffic/delete_traffic'] = array('admin/TrafficController', 'delete_traffic');
$route['*']['/admin/traffic/index'] = array('admin/TrafficController', 'index');
$route['*']['/admin/traffic/update_time_parks'] = array('admin/TrafficController', 'update_time_parks');
$route['*']['/admin/traffic/update_drivers_bus'] = array('admin/TrafficController', 'update_driver_bus');
$route['*']['/admin/traffic/search_traffic'] = array('admin/TrafficController', 'search_traffic');
$route['*']['/admin/traffic/save_traffic'] = array('admin/TrafficController', 'save_traffic');
$route['*']['/admin/traffic/index_reorder_bus/save'] = array('admin/TrafficController', 'index_reorder_bus_save');
$route['*']['/admin/traffic/index_reorder_bus/:time'] = array('admin/TrafficController', 'index_reorder_bus');
/* Reportes */
$route['*']['/admin/traffic/daily_arrival_pdf/:date'] = array('admin/TrafficController', 'daily_arrival_pdf');
$route['*']['/admin/traffic/guides_services_pdf/:date/:time'] = array('admin/TrafficController', 'guides_services_pdf');
$route['*']['/admin/traffic/tickets_pdf/:date'] = array('admin/TrafficController', 'tickets_pdf');
/* Buses para trafico */
$route['*']['/admin/traffic/buses/index'] = array('admin/TrafficBusController', 'index');
$route['*']['/admin/traffic/buses/add'] = array('admin/TrafficBusController', 'add');
$route['post']['/admin/traffic/buses/save'] = array('admin/TrafficBusController', 'save');
$route['*']['/admin/traffic/buses/edit/:id'] = array('admin/TrafficBusController', 'edit');
$route['*']['/admin/traffic/buses/delete'] = array('admin/TrafficBusController', 'delete');
/* Type tickets para trafico */
$route['*']['/admin/traffic/type_tickets/index'] = array('admin/TrafficTypeTicketController', 'index');
$route['*']['/admin/traffic/type_tickets/add'] = array('admin/TrafficTypeTicketController', 'add');
$route['post']['/admin/traffic/type_tickets/save'] = array('admin/TrafficTypeTicketController', 'save');
$route['*']['/admin/traffic/type_tickets/edit/:id'] = array('admin/TrafficTypeTicketController', 'edit');
$route['*']['/admin/traffic/type_tickets/delete'] = array('admin/TrafficTypeTicketController', 'delete');
//Facturacion
$route['*']['/admin/facturacion'] = array('admin/FacturacionController','invoicing');
$route['*']['/admin/facturacion/afacturar/:fecha_inicial/:fecha_final/:filtro/:texto'] = array('admin/FacturacionController','get_reserves');
$route['*']['/admin/facturacion/proceso'] = array('admin/FacturacionController','process_invoice');
$route['*']['/admin/facturas'] = array('admin/FacturacionController','invoices');
$route['*']['/admin/buscarfacturas/:start/:end/:filter/:texto'] = array('admin/FacturacionController','search_invoices');
$route['*']['/admin/facturacion/details/:id'] = array('admin/FacturacionController','get_invoice');
$route['*']['/admin/facturacion/details/services/:id'] = array('admin/FacturacionController','get_invoice_services');
$route['*']['/admin/facturacion/genpdf/:id'] = array('admin/FacturacionController','genpdf');
$route['*']['/admin/facturacion/factura/:id'] = array('admin/FacturacionController','getInvoicebyid');
$route['get']['/admin/facturacion/cancelar'] = array('admin/FacturacionController','cancel_invoice');
$route['post']['/admin/facturacion/cancelar'] = array('admin/FacturacionController','cancel_process');
$route['*']['/admin/facturacion/canceladas'] = array('admin/FacturacionController','canceled_invoices');
$route['*']['/admin/buscarcanceladas/:filter/:texto'] = array('admin/FacturacionController','search_cinvoices');
$route['*']['/admin/cancel_report/:id'] = array('admin/FacturacionController','cancel_report');
$route['*']['/admin/facturacion/edit/:id'] = array('admin/FacturacionController','edit_invoice');
$route['*']['/admin/reinvoicing'] = array('admin/FacturacionController','is_reinvoicing');
$route['*']['/admin/facturacion/refacturar/:id'] = array('admin/FacturacionController','remake_process');
//Pagos
$route['*']['/admin/pagos'] = array('admin/PagosController','generar_pago');
$route['*']['/admin/pagos/:id'] = array('admin/PagosController','generar_pago');
$route['*']['/admin/loadagency/:id'] = array('admin/PagosController','loadagency');
$route['*']['/admin/loadinvoices/:id'] = array('admin/PagosController','get_invoicesa');
$route['*']['/admin/loadpaidinvoices/:id'] = array('admin/PagosController','get_paid_invoicesa');
$route['*']['/admin/pagos/proceso'] = array('admin/PagosController','realizar_pago');
//Ventas
$route['*']['/admin/loadinvoicessu'] = array('admin/PagosController','supertours_sales');
$route['*']['/admin/loadpaidinvoicessu'] = array('admin/PagosController','get_invoicessu');
//reportes
$route['*']['/admin/reports/index'] = array('admin/ReportsController', 'reports_index');
// Statement Report
$route['*']['/admin/reports/statement_report/:id_agency'] = array('admin/ReportsController','statement_report');
//Cost_day Report
$route['*']['/admin/reports/cost_day_report'] = array('admin/ReportsController','cost_day_report');
$route['*']['/admin/reports/cost_range_report/:fini/:ffin'] = array('admin/ReportsController','cost_range_report');
$route['*']['/admin/reports/reserve_collect_report/:fecha_inicio/:fecha_final'] = array('admin/ReportsController','reserve_collect_report');
$route['*']['/admin/reports/ventas_tours_report/:estado/:tipo/:fecha_inicio/:fecha_final'] = array('admin/ReportsController','ventas_tours_report');
$route['*']['/admin/reports/entry_services_report/:fecha_inicio/:fecha_final'] = array('admin/ReportsController','entry_services_report');
$route['*']['/admin/reports/total_tickets_report/:fecha_inicio/:fecha_final'] = array('admin/ReportsController','total_tickets_report');
$route['*']['/admin/reports/total_service_by_client/:id_cliente'] = array('admin/ReportsController','total_service_by_client');
$route['*']['/admin/reports/transfer_services_report/:fecha_inicio/:fecha_final'] = array('admin/ReportsController', 'transfer_services_report');
$route['*']['/admin/reports/coms_and_refunds/:fecha_inicio/:fecha_fin'] = array('admin/ReportsController','comission_refunds');
$route['*']['/admin/reports/hotel_services_report/:fecha_inicio/:fecha_final'] = array('admin/ReportsController', 'hotel_services_report');


//RUTAS PARA PARTE MOBILE
$route['*']['/mobile/index'] = array('MainController', 'mobile_index');

// INFORMACION DEL PASAJERO
$route['*']['/setting_info'] = array('MainController', 'settinguser');
$route['*']['/setting_info/update_info'] = array('MainController', 'updateinfo');

$route['*']['/save/information'] = array('MainController', 'saveinfouser');
$route['*']['/get/ajaxcountry'] = array('MainController', 'ajaxcountry');
$route['*']['/get/ajaxstate'] = array('MainController', 'ajaxstate');

$route['*']['/setting_info/update_pass'] = array('MainController', 'updatepass');
$route['*']['/setting_info/deletecontact/:id'] = array('MainController', 'deletecontact');
$route['*']['/setting_info/sendcontact'] = array('MainController', 'sentcontact');
$route['*']['/General_Info'] = array('MainController', 'GeneralInfo');
$route['*']['/autentication/userlogin'] = array('MainController', 'userlogin');

$route['*']['/booking/pickup-dropoff/autentication/shopuser_inv'] = array('MainController', 'shopuser_inv');
$route['*']['/booking/pickup-dropoff/autentication/shopuser'] = array('MainController', 'confir');



// ADMINISTRADOR DE LA WEB

$route['*']['/adminweb/configuration'] = array('AdminWebController', 'configuration');
$route['*']['/adminweb/configuration/save_img'] = array('AdminWebController', 'save_img');
