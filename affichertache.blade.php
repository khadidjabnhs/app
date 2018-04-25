@include('header')
<html lang="en">
    
<head>
     <meta charset="utf-8">
   

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.jpg') }}">

    <!-- CSFR token for ajax call -->
    <meta name="_token" content="{{ csrf_token() }}"/>

    <title>Gestion</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"-->
    
  <!--link rel="stylesheet" type="text/css" href="{{ url('css/style.min.css') }}">

    <!-- icheck checkboxes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/yellow.css">

    <!-- toastr notifications -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">


    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    
   

   
</head>



     @if (session('info')) 
                    <div class="col-mg-4 alert alert-success">
                       {{session('info')}}
                         </div>
         @endif 

 
 


<body bgcolor="#90caf9">
    
<div class="container">

<div class="row">  
    
    <div class="col-lg-2">
            
           
      </div>
     
                      
                      

         
      
    
     <div class="col-lg-5">
 
     
    </div>
    
    
    <div class="table table-responsive">
    <table class="table table-bordered" id="table" >
      <tr>
       
        <th>titre</th>
        <th>equipe</th>
           <th>priorité</th>
           <th>Address</th>
           <th>Longtitue</th>
           <th>Laltitude</th>
       
        <th class="text-center" width="10px">
            <a href="{{ url('planing') }}" class=" btn btn-success btn-sm">
            <i class="glyphicon glyphicon-plus"></i>
          </a>
        </th>
      </tr>
                   
        <tbody>
            @foreach($taches as $t )
            <tr>
             <td>{{ $t -> titre }}</td>
                <td>
                   
                    {{ isset($t->equipe)? $t->equipe->nom : ''}}
                  
                </td>
                <td>{{ $t -> priorite }}</td>
                 <td>{{ $t -> address }}</td>
                  <td>{{ $t -> lng }}</td>
                   <td>{{ $t -> lat }}</td>
                <td>
                    <button class="edit-modal btn btn-primary"  data-titre="{{$t->titre}}" 
                            data-equipe="{{$t->equipe}}" data-priorite="{{$t->priorite}}" data-duree="{{$t->duree}}"
                            onclick="editItem({{$t ->id}})">
                        <span class="glyphicon glyphicon-pencil"></span> 
                    </button>
                     <button class="delete-modal btn btn-danger"  data-id="{{$t->id}}"  data-titre="{{$t->titre}}" 
                            data-equipe="{{$t->equipe}}" data-priorite="{{$t->priorite}}" data-duree="{{$t->duree}}" 
                            onclick="removeItem({{$t ->id}})">
                        <span class="glyphicon glyphicon-remove"></span> 
                    </button> 
                    
                </td>
            </tr>
            @endforeach
        </tbody>

                    </table>
        
        <table class="table table-bordered" id="table" >
      <tr>
       
        <th>titre</th>
        <th>equipe</th>
           <th>priorité</th>
           <th>Address</th>
           <th>Longtitue</th>
           <th>Laltitude</th>
       
        <th class="text-center" width="10px">
            <a href="{{ url('planing') }}" class=" btn btn-success btn-sm">
            <i class="glyphicon glyphicon-plus"></i>
          </a>
        </th>
      </tr>
            <tbody>
                @foreach($taches_noeq as $t )
                <tr>
                 <td>{{ $t -> titre }}</td>
                    <td>
                       
                        {{ isset($t->equipe)? $t->equipe->nom : ''}}
                     
                    </td>
                          <td>{{ $t -> priorite }}</td>
                          <td>{{ $t -> address }}</td>
                          <td>{{ $t -> lng }}</td>
                          <td>{{ $t -> lat }}</td>
                          <td>
                       </td>
                    <td>
                        <form method="POST" action="{{url('tache/'.$t->id.'/change')}}">
                            {{csrf_field()}}
                            <select  name="equipe_id"  class="form-control" id="equipe_id">

                               <option value=""></option>
                                @foreach($equipes as $equipe)
                                <option value="{{$equipe->id}}">{{$equipe->nom}}</option>
                                @endforeach
                            </select>
                            <button type="submit">Save</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
     </div>
    </div>      
 </div> 

 <!-- Modal form to delete a form -->
    <div id="deleteModalT" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <h3 class="text-center">Êtes-vous sûr de vouloir supprimer cette tache !?</h3>
                    <br />
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id">ID:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id_delete" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="titre">titre:</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control" id="titre_delete" disabled>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Fermer
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
     <!-- Modal form to edit a form -->
    <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        
                        
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="id">ID:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id_edit" autofocus>
                                <p class="errornom text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                      
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="titre">titre:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="titre_edit" autofocus>
                                <p class="errornom text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="equipe">equipe:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="equipe_edit" cols="40" ></textarea>
                                <p class="errorchef text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="control-label col-sm-2" for="priorite">priorité:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="priorite_edit" cols="40" rows="5"></textarea>
                                <p class="errordescription text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="duree">durée:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="duree_edit" cols="40" rows="5"></textarea>
                                <p class="errordescription text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary edit" data-dismiss="modal">
                            <span class='glyphicon glyphicon-check'></span> Modifier
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Fermer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />


 <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>

    <!-- Bootstrap JavaScript -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.1/js/bootstrap.min.js"></script>

    <!-- toastr notifications -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- icheck checkboxes -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>

    <!-- Delay table load until everything else is loaded -->
    <script>
        $(window).load(function(){
            $('#tacheTable').removeAttr('style');
        })
    </script>

    

 <!-- AJAX CRUD operations -->
    <script type="text/javascript">
       
       function removeItem (itemId) {
        if(itemId) {
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                type: 'post',
                url: 'deleteItem',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'itemId' : itemId
                },
                success: function(data) {
                    if(data == 1) {
                        window.location.href = "";
                    }
                }
             });
          }
       }

       function editItem (itemId) {
        // if(itemId) {
        //     $.ajax({
        //         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        //         type: 'post',
        //         url: 'deleteItem',
        //         data: {
        //             '_token': $('input[name=_token]').val(),
        //             'itemId' : itemId
        //         },
        //         success: function(data) {
        //             if(data == 1) {
        //                 window.location.href = "";
        //             }
        //         }
        //      });
        //   }
       }

        
         // delete a post
        $(document).on('click', '.delete-modal', function() {
            $('.modal-title').text('Supprimer');
            $('#id_delete').val($(this).data('id'));
            $('#titre_delete').val($(this).data('titre'));
            $('#deleteModalT').modal('show');
            id = $('#id_delete').val();
            console.log('HI');
        });
        $('.modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'DELETE',
                url: 'taches/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function(data) {
                    toastr.success('La tache a été supprimé avec succée', 'Success Alert', {timeOut: 5000});
                    $('.item' + data['id']).remove();
                }
            });
        });
        
        
         // Edit a post
        $(document).on('click', '.edit-modal', function() {
            $('.modal-title').text('Modifier');
            $('#id_edit').val($(this).data('id'));
            $('#titre_edit').val($(this).data('titre'));
            $('#equipe_edit').val($(this).data('equipe'));
            $('#priorite_edit').val($(this).data('priorite'));
             $('#duree_edit').val($(this).data('duree'));
            id = $('#id_edit').val();
            $('#editModal').modal('show');
        });
        $('.modal-footer').on('click', '.edit', function() {
            $.ajax({
                type: 'PUT',
                url: 'equipes/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $("#id_edit").val(),
                    'titre': $('#titre_edit').val(),
                     'equipe': $('#equipe_edit').val(),
                    'priorite': $('#priorite_edit').val(),
                     'duree': $('#duree_edit').val()
                },
                success: function(data) {
                    $('.errortitre').addClass('hidden');
                    $('.errorequipe').addClass('hidden');
                      $('.errorpriorite').addClass('hidden');
                     $('.errorduree').addClass('hidden');

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#editModal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.titre) {
                            $('.errortitre').removeClass('hidden');
                            $('.errortitre').text(data.errors.titre);
                        }
                        if (data.errors.equipe) {
                            $('.errorequipe').removeClass('hidden');
                            $('.errorequipe').text(data.errors.equipe);
                        }
                         if (data.errors.priorite) {
                            $('.errorpriorite').removeClass('hidden');
                            $('.errorpriorite').text(data.errors.priorite);
                        }
                        
                         if (data.errors.duree) {
                            $('.errorduree').removeClass('hidden');
                            $('.errorduree').text(data.errors.duree);
                        }
                    } else {
                        toastr.success(' la tache a été modifié avec succé!', 'Success Alert', {timeOut: 5000});
                        $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.titre + "</td><td>" + data.equipe + "</td><td>" + data.priorite + "</td><td>" + data.duree + "</td><td class='text-center'><input data-id='" + data.id + "'></td><td>Right now</td><td><button class='show-modal btn btn-success' data-id='" + data.id + "' data-titre='" + data.titre + "' data-equipe='" + data.equipe + "' data-priorite='" + data.priorite + "' data-duree='" + data.duree + "'><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-titre='" + data.titre + "' data-equipe='" + data.equipe + "'data-priorite='" + data.priorite + "' data-duree='" + data.duree + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-titre='" + data.titre + "' data-equipe='" + data.equipe + "' data-priorite='" + data.priorite + "' data-duree='" + data.duree + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

                       
                        
                       
                       
                    }
                }
            });
        });
        
         </script>
     </body>
