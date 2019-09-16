@extends('layouts.app')

@section('content')

<div class="container">
     <div class="row">
         <div class="col-md-8 mx-auto">
             <div class="card">
                 <div class="card-header">
                     <h3>Products</h3>

                     <div class="card-body">
                         <table class="table">
                             <thead>
                                 <th>Name</th>
                                 <th>Price</th>
                                 <th>Edit</th>
                                 <th>Delete </th>

                             </thead>

                             <tbody>
                                 @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>

                                        <td>{{ $product->price }}</td>

                                        <td>
                                            <a href="{{ route('products.edit', ['id' => $product->id ]) }}" class="btn btn-secondary btn-xs">Edit</a>
                                        </td>

                                        <td>
                                            <form action="{{ route('products.destroy', ['id' => $product->id ]) }}" method="post">

                                                {{ csrf_field() }}

                                                {{ method_field('DELETE') }}

                                                <button class="btn btn-xs btn-danger">Delete</button>

                                            </form>
                                        </td>
                                    </tr>
                                 @endforeach
                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
         </div>
</div>


@endsection