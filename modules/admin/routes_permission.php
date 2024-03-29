<?php
/**
 * Created by PhpStorm.
 * User: selim
 * Date: 12/8/2015
 * Time: 5:54 PM
 */
Route::any('index-permission', [
   'middleware' => 'acl_access:index-permission',
    'as' => 'index-permission',
    'uses' => 'PermissionController@index'
]);

Route::any('store-permission', [
   'middleware' => 'acl_access:store-permission',
    'as' => 'store-permission',
    'uses' => 'PermissionController@store'
]);

Route::any('view-permission/{id}', [
   'middleware' => 'acl_access:view-permission/{id}',
    'as' => 'view-permission',
    'uses' => 'PermissionController@show'
]);

Route::any('edit-permission/{id}', [
   'middleware' => 'acl_access:edit-permission/{id}',
    'as' => 'edit-permission',
    'uses' => 'PermissionController@edit'
]);

Route::any('update-permission/{id}', [
   'middleware' => 'acl_access:update-permission/{id}',
    'as' => 'update-permission',
    'uses' => 'PermissionController@update'
]);

Route::any('delete-permission/{id}', [
   'middleware' => 'acl_access:delete-permission/{id}',
    'as' => 'delete-permission',
    'uses' => 'PermissionController@destroy'
]);


Route::any('route-in-permission', [
   'middleware' => 'acl_access:route-in-permission',
    'as' => 'route-in-permission',
    'uses' => 'PermissionController@route_in_permission'
]);

//permission role route---------------------
Route::any('index-permission-role', [
   'middleware' => 'acl_access:index-permission-role',
    'as' => 'index-permission-role',
    'uses' => 'PermissionRoleController@index'
]);

Route::any('store-permission-role', [
   'middleware' => 'super_admin_access:store-permission-role',
    'as' => 'store-permission-role',
    'uses' => 'PermissionRoleController@store'
]);

Route::any('view-permission-role/{id}', [
   'middleware' => 'acl_access:view-permission-role/{id}',
    'as' => 'view-permission-role',
    'uses' => 'PermissionRoleController@show'
]);

Route::any('edit-permission-role/{id}', [
   'middleware' => 'acl_access:edit-permission-role/{id}',
    'as' => 'edit-permission-role',
    'uses' => 'PermissionRoleController@edit'
]);

Route::any('update-permission-role/{id}', [
   'middleware' => 'acl_access:update-permission-role/{id}',
    'as' => 'update-permission-role',
    'uses' => 'PermissionRoleController@update'
]);

Route::any('delete-permission-role/{id}', [
   'middleware' => 'acl_access:delete-permission-role/{id}',
    'as' => 'delete-permission-role',
    'uses' => 'PermissionRoleController@destroy'
]);

Route::get('search-permission-role', [
   'middleware' => 'acl_access:search-permission-role',
    'as' => 'search-permission-role',
    'uses' => 'PermissionRoleController@search_permission_role'
]);
