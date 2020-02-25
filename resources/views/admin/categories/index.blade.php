@extends('layouts/admin.app-admin')
@section('content')
<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="{{asset('img/sidebar-5.jpg')}}">

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="{{url('/')}}" class="simple-text">
                    JobFinder Team
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="{{url('/admin')}}">
                        <i class="pe-7s-culture"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="active">
                    <a href="{{url('/admin/categories')}}">
                        <i class="pe-7s-monitor"></i>
                        <p>Show All Categories</p>
                    </a>
                </li>
                <li>
                    <a href="{{url('/admin/categories/create')}}">
                        <i class="pe-7s-plus"></i>
                        <p>New Category</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{url('/admin/categories')}}">Categories</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="{{url('/admin')}}" class="dropdown-toggle" data-toggle="dropdown">

								<p class="hidden-lg hidden-md">Categories</p>
                            </a>
                        </li>

                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="{{url('dashboard/acount/'.auth()->user()->id)}}">
                               <p>Account</p>
                            </a>
                        </li>

                        <li>
                            <a href="/#" onclick="document.getElementById('form-logout').submit();"><p>Log out</p></a>
                            <form action="{{url('logout')}}" method='POST' id='form-logout'>{{csrf_field()}}</form>
                            </li>
						<li class="separator hidden-lg"></li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class='row'>
                    <div class='col-md-4'>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/admin')}}">Admin</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/categories')}}">Categories</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Show</li>
                            </ol>
                        </nav>
                    </div>
                    <div class='col-md-8'>
                        <form method='GET' action="{{url('admin/categories')}}">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for..." name='keywords' value="{{request()->has('keywords')?request()->input()['keywords']:''}}">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">Search</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
                <br>
                @if(\Session::has('success'))
                <div class='row'>
                    <div class='col-md-12'>
                        <div class='card'>
                          <p class='alert alert-success'>{{\Session::get('success')}}</p>
                        </div>
                    </div>
                </div>
                @endif
                <div class='row'>
                    <div class='col-md-12'>
                    <div class="card">
                           <!-- <div class="header">
                                <h4 class="title">Striped Table with Hover</h4>
                                <p class="category">Here is a subtitle for this table</p>
                            </div>-->
                            
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>

                                        <th>ID</th>
                                        @if(request()->has('orderBy') && request('orderBy') === 'name' && !request('sortOrder'))
                                    	<th><a href="{{url('admin/categories')}}?orderBy=name&sortOrder=desc{{request()->has('keywords')?'&keywords='.request()->input()['keywords']:''}}">Name</a></th>
                                        @else
                                        <th><a href="{{url('admin/categories')}}?orderBy=name{{request()->has('keywords')?'&keywords='.request()->input()['keywords']:''}}">Name</a></th>
                                        @endif
                                        @if(request()->has('orderBy') && request('orderBy') === 'icon' && !request('sortOrder'))
                                    	<th><a href="{{url('admin/categories')}}?orderBy=icon&sortOrder=desc{{request()->has('keywords')?'&keywords='.request()->input()['keywords']:''}}">Icon</a></th>
                                        @else
                                        <th><a href="{{url('admin/categories')}}?orderBy=icon{{request()->has('keywords')?'&keywords='.request()->input()['keywords']:''}}">Icon</a></th>
                                        @endif
                                        @if(request()->has('orderBy') && request('orderBy') === 'created_at' && !request('sortOrder'))
                                    	<th><a href="{{url('admin/categories')}}?orderBy=created_at&sortOrder=desc{{request()->has('keywords')?'&keywords='.request()->input()['keywords']:''}}">Created At</a></th>
                                        @else
                                        <th><a href="{{url('admin/categories')}}?orderBy=created_at{{request()->has('keywords')?'&keywords='.request()->input()['keywords']:''}}">Created At</a></th>
                                        @endif
                                        @if(request()->has('orderBy') && request('orderBy') === 'updated_at' && !request('sortOrder'))
                                        <th><a href="{{url('admin/categories')}}?orderBy=updated_at&sortOrder=desc{{request()->has('keywords')?'&keywords='.request()->input()['keywords']:''}}">Updated At</a></th>
                                        @else
                                        <th><a href="{{url('admin/categories')}}?orderBy=updated_at{{request()->has('keywords')?'&keywords='.request()->input()['keywords']:''}}">Updated At</a></th>
                                        @endif
                                        <th>Action</th>
                                        <th>Action</th>
                                        
                                    </thead>
                                    <tbody>
                                        @foreach($categories as $category)
                                        <tr align="left">
                                            <td>{{$category->id}}</td>
                                            <td>{{$category->name}}</td>
                                            <td>{{$category->icon}}</td>
                                            <td>{{$category->created_at}}</td>
                                            <td>{{$category->updated_at}}</td>
                                            <td><a href="{{url('admin/categories/'.$category->id.'/edit')}}" class='btn btn-info'>Edit</a></td>
                                            <td>
                                                <form method='POST' class='form-delete' action="{{url('admin/categories/'.$category->id)}}">
                                                    <button type='submit' class='btn btn-info'>Delete</button>
                                                    <input type='hidden' name='_method' value='DELETE'>
                                                    {{csrf_field()}}
                                                 </form>
                                            </td>
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class='col-md-offset-1'>
                        {{$categories->appends(request()->input())->links()}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class='col-md-12'>
                    <a class="btn btn-info btn-fill pull-right" href="{{url('admin/categories/create')}}">Create Anew Category</a>
                    </div>
                </div>
                <br>
@endsection
@section('scripts')
<script type="text/javascript">
    	$(document).ready(function(){

        	demo.initChartist();

        	$.notify({
            	icon: 'pe-7s-gift',
            	message: "Welcome to <b>Light Bootstrap Dashboard</b> - a beautiful freebie for every web developer."

            },{
                type: 'info',
                timer: 4000
            });

            $('.form-delete').on('submit',function(){
                if(confirm('Are You Sure Baby?')){
                    return true;
                }else{
                    return false;
                }
            });
    	});
	</script>
@endsection
