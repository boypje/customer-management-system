<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// controller device

Auth::routes();



Route::group(['middleware' => ['auth','permission:Access admin page']], function (){

	Route::get('/', function () {
    //return view('welcome');
	    return redirect()->route('admin');
	});
});

/***
 *                             _
 *                            | |
 *      _ __    ___    _   _  | |_    ___
 *     | '__|  / _ \  | | | | | __|  / _ \
 *     | |    | (_) | | |_| | | |_  |  __/
 *     |_|     \___/   \__,_|  \__|  \___|
 *
 *
 */

 Route::group(['middleware'=> ['role:Super Admin|HR Staff Senior|HR Manager|Desk Collection|Collection Manager|Admin']], function(){
    
});

//starting point new route classification
Route::group(['prefix'=>'admin', 'namespace' => 'admin'], function () {

	//admin index will be halaman awal setelah login
	Route::get('','DashboardController@index')->name('admin');

	// route hr mengelola user
    Route::group(['middleware'=> ['role:Super Admin|HR Staff Senior|HR Manager|Desk Collection|Collection Manager|Admin']], function(){
       // to index hr
       
        Route::get('hr','HRController@index')->name('hr');
        // getdata user by id aktif/tidak aktif
        Route::get('hr/getDataUserbyStatus/{status}','HRController@getDataUserbyStatus');
        // ke view data user yang tidak aktif
        Route::get('hr/getDataUserTidakAktif','HRController@viewUserTidakAktif')->name('userTidakAktif');
        // view upload user
        Route::get('hr/uploadDataView','HRController@uploadDataView')->name('uploadView');
        // post excel user to db
        Route::post('hr/uploadData','HRController@uploadData')->name('uploadData');
        // get tamplate karyawan
        Route::get('hr/getFormatKaryawan','HRController@getTamplateExcel')->name('getTamplate');
        // merubah status
        Route::post('hr/editStatusById/{id}','HRController@editstatus');
        // menambah note
        Route::post('hr/noteDeactiveUser','HRController@deactiveUser')->name('noteDeactiveUser');
        // inser data user ke db
        Route::post('hr/inputUser','HRController@create')->name('inputUser');
        // getdata edit user
        Route::get('hr/editUser/{id}','HRController@editUser')->name('editUser');
        // route post update data user
        Route::post('hr/updateUser','HRController@updateUser')->name('updateDataUser');
        // reset password akun
        Route::get('hr/reset-password-user','HRController@reset_password_id')->name('resetPasswordUsers');
        Route::post('hr/post-data-karyawan/','HRController@sendIDKarayawan')->name('sendIDKaryawan');
        // lihat data karyawan
        Route::get('hr/view-data-karyawan/{id}','HRController@viewDatakaryawan')->name('viewDataKaryawan');
        route::get('hr/pdf-data-karyawan/{id}','HRController@getViewDataKarayawan')->name('getViewDataKaryawan');
        Route::resource('devices', 'DeviceController');
        
        Route::get('device/scan/{name}', 'DeviceController@scan')->name('devices.scan');
        Route::put('device/update/{id}', 'DeviceController@update')->name('devices.update');
        Route::get('device/disconnect/{name}', 'DeviceController@disconnect')->name('devices.disconnect');

        Route::post('device/{name}/update-status', 'DeviceController@updateStatus');

        Route::get('device/history/{id}', 'DeviceController@history')->name('devices.history');
        Route::get('device/chats/{id}', 'DeviceController@chats')->name('devices.chats');
        Route::get('/device/{deviceId}/chats/{outboxNumber}', 'DeviceController@showChat')->name('devices.showChat');


        Route::resource('outbox', 'OutboxController');


    });

    Route::group(['prefix' => 'customer', 'middleware' => ['auth','isDC']], function(){
        Route::get('index','CustomerController@index')->name('customer');
        Route::get('form','CustomerController@formCustomer')->name('formCustomer');
        // update dpd
        Route::post('updateDpd','CustomerController@updateDpd')->name('updateDPD');
        // insert data customer
        Route::post('post-data','CustomerController@create')->name('insertCustomer');
        // device
        
        // get data customer
        // Route::get('getdata-customer','CustomerController@getData')->name('getDataCustomer');
        // get tamplate customer
		Route::get('getFormatCustomer','CustomerController@getTamplateExcelCustomer')->name('getTamplateCustomer');
        // post excel customer to db
		Route::post('uploadDataCustomer','CustomerController@uploadDataCustomer')->name('uploadDataCustomer');

        // update data Contact customer
        Route::post('update-data-contact-customer','CustomerController@updateDataContactcustomer')->name('addContackCustomer');
        // update data Sosmed customer
        Route::post('update-data-sosmed-customer','CustomerController@updateDataSosmedcustomer')->name('addSosmedCustomer');
        // edit data customer
        route::get('view-edit-data-customer/{id}','CustomerController@viewEditCustomer')->name('viewEditCustomer');
        Route::get('edit-data-customer/{id}','CustomerController@editDataCustomerById')->name('editCustomer');
        route::get('to-view-customer/{id}','CustomerController@viewDataCustomer')->name('viewDataCustomer');
        // get customer detail (contact, address)
        Route::get('get-data-detail-customer-by/{id}','CustomerController@getDataCustomer');
        Route::get('get-data-contact-customer-by/{id}','CustomerController@getDataContact');
        Route::get('get-data-sosmed-customer-by/{id}','CustomerController@getDataSosmed');
        // get data kontak & sosmed customer for edited
        Route::get('get-contact-customer-by/{id}', 'CustomerController@getContactForEdited')->name('editCustomerContact');
        Route::get('get-sosmed-customer-by/{id}', 'CustomerController@getSosmedForEdited');
        // edit data sosmed & kontak customer
        Route::post('edit-data-contact-by/{id}','CustomerController@editDataKontak')->name('editKontakCustomer');
        Route::post('edit-data-sosmed-by/{id}','CustomerController@editDataSosmed')->name('editKontakCustomer');

        //test controller
        Route::get('getData-customer','testController@adminTable');
        Route::get('getData-deskCollection','testController@agentTable');
        Route::get('view-deskCollection','testController@viewAgentTable');

        

    });

    Route::group(['prefix' => 'remark'], function(){
        // user remark
        // Route::post('createRemarkCustomer','RemarksController@createRemarkCustomer')->name('createRemarkCustomer');
        Route::post('remarkDataCustomer','RemarksController@remarkCustomer')->name('remarkCustomer');
        Route::post('remarkDataDetailCustomer','RemarksController@remarkDetailCustomer')->name('remarkDetailCustomer');
        Route::get('getdate-remark/{id}','RemarksController@getdataRemark');

        Route::post('recordDetailRemarkCall','RemarksController@recordDetailRemarkCall')->name('recordDetailRemarkCall');

    });

    Route::group(['prefix' => 'calling'], function(){
        // user remark
        Route::post('createCallReport','CallReportController@createReportCall')->name('createReportCall');
        Route::post('endCallReport','CallReportController@endReportCall')->name('endReportCall');

    });

    Route::group(['prefix' => 'platform'], function(){
        // view index platform
        Route::get('index','PlatformController@index')->name('platform');
        // view input form platform
        Route::get('form','PlatformController@formPlatform')->name('formPlatform');
        Route::get('form/sub-klien','PlatformController@subKlien')->name('formSubKlien');
        Route::get('viewAgentManage','PlatformController@viewAgentManage')->name('viewAgentManage');
        // fungsi store platform
        Route::post('post/platform','PlatformController@store')->name('storePlatform');
        Route::post('post/klien','PlatformController@storeKlien')->name('storeKlien');
        Route::post('post/bucketKlien','PlatformController@storeBucketKlien')->name('storeSubPlatform');
        Route::post('post/manageAgent','PlatformController@storemanageAgent')->name('manageAgent');
        // get data 
        Route::get('getdata','PlatformController@getData')->name('dataPlatform');
        Route::get('getdataBucket','PlatformController@getDataBucketClinet')->name('getDataBucketClinet');
        Route::get('getDataClinet','PlatformController@getDataClinet')->name('getDataClinet');

    });
    Route::group(['prefix' => 'monitoring'], function(){
        Route::get('view-monitoring','MonitoringController@index')->name('monitoringView');
        Route::get('get-data-monitoring','MonitoringController@getDataMonitoring');
        Route::get('view-monitoring-remark-payment','MonitoringController@monitoringRemarkAgent')->name('monitoringRemarkAgent');
        // Route::get('view-monitoring-remark-payment','MonitoringController@monitoringRemarkAgent')->name('monitoringRemarkAgent');
        //report remark
        Route::get('report-remark-Agent','MonitoringController@reportAgentRemark')->name('reportRemarkAgent');
        Route::get('detail-report-remark/{id}','MonitoringController@detailRemarkAgent')->name('detailReportRemark');
        //report payment
        Route::get('report-payment-Agent','MonitoringController@reportAgentPayment')->name('reportPaymentAgent');
        Route::get('detail-report-payment/{id}','MonitoringController@detailPaymentAgent')->name('detailReportPayment');
        //export report remark & payment
        Route::get('export-report-remark/{id}','MonitoringController@exportRemarkAgent')->name('exportReportRemark');
        Route::get('export-report-payment/{id}','MonitoringController@exportPaymentAgent')->name('exportReportPayment');

        Route::get('exportTimReportRemark/{id}','MonitoringController@exportTimReportRemark')->name('exportTimReportRemark');

        Route::get('reportCallingReportAgent','CallReportController@index')->name('reportCallingReportAgent');
        Route::get('collectionActivityReport/{id}','CallReportController@collectionActivityReport')->name('collectionActivityReport');
        Route::get('exportCallingReportLink/{id}','CallReportController@exportCallingReportLink')->name('exportCallingReportLink');
        
    });


    Route::group(['prefix' => 'payment'], function(){
        // user payment
        Route::post('store-payment-customer','PaymentsController@createPaymentCustomer')->name('createPayment');
        Route::get('getdata-payment/{id}','PaymentsController@getdataPayment');
        Route::post('upload-bukti-bayar','PaymentsController@UploadBuktiBayar')->name('uploadBuktiBayar');

        Route::get('index-report-payment','PaymentsController@reportPayment')->name('reportPayment');
        Route::get('verify-proof-of-payment/{id}','PaymentsController@verifyProofOfPayment')->name('verifyProofOfPayment');
    });

    Route::group(['prefix' => 'roles'], function(){
    	Route::get('getdata','RoleController@getData');
    	Route::put('{id}','RoleController@update');
    	Route::get('role-details/{id}', 'RoleController@getMasterDetailsSingleData')->name('api.role_single_details');
		Route::get('role-details', 'RoleController@getMasterDetailsData')->name('api.role_details');
    });

    Route::group(['prefix' => 'permissions'], function(){
    	Route::get('getdata','PermissionController@getData');
    });

    //route resource (only resource)
    Route::resource('roles', 'RoleController'); // bug on update ( admin/roles/{id} 404 not found, tapi data sukses terupdate )
    Route::resource('permissions', 'PermissionController');

});

// prefix user
Route::group(['prefix'=>'user', 'namespace' => 'admin', 'middleware' => ['auth','isDC']], function () {
	// profile user
	Route::group(['middleware'=> ['role:Super Admin|Secretary|HR Staff|HR Manager|Leader DC|Collection Manager|Supervisor DC|Desk Collection|Director|Admin|Komisaris|Operasional Manager|Management|QA & Legal Manager|IT Manager|General Affair Staff|IT Staff|FAT Manager|Tax Staff|Translator Mandarin|Legal Staff|Medic Staff|Driver|Resepsionis|Security|Office Boy|Office Girl|HR Staff Senior']], function(){
		// to profile user
		Route::get('profile/{id}','ProfileController@viewProfileById')->name('profile');
		//get data gaji user
		Route::get('profile/getDataSalaryUserById/{id}','ProfileController@getDataSalaryUserById')->name('ownSalary');
		// ubah password via profile
		Route::post('profile/editPasswordProfile','ProfileController@editPasswordProfile')->name('editPassword');
        // ubah password user
        Route::post('profile/editPassword','ProfileController@editPassword')->name('editPasswordUsers');
        // to view change password
        Route::get('profile/changePassword/{id}','ProfileController@viewChangePassword')->name('viewChangePassword');
	});
});

Route::group(['namespace' => 'admin', 'middleware'=> ['role:Super Admin|HR Staff Senior|HR Manager']] , function () {
    Route::get('recrutment','RecrutmentController@index')->name('recrutment');

});

Route::group(['namespace' => 'admin', 'middleware'=> ['role:Super Admin|Resepsionis']] , function () {
    Route::get('index','RecrutmentController@index')->name('indexResepsionist');
    Route::get('check-data-recruit','RecrutmentController@checkNIK')->name('getDataCalonKaryawan');
});
