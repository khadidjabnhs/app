@include('header')


     @if (session('info'))
                    <div class="col-mg-6 alert alert-success">
                       {{session('info')}}
                         </div>
         @endif 

                  
<div class="container">

<div class="row">  
                  
            <div class="col-lg-12">

           
                  <div class="card border-light mb-3" style="max-width: 50rem;">
  <div class="card-header">Ajouter une nouvelle tache</div>
  <div class="card-body text-dark">
    <h4 class="card-title"> </h4>
      <div class="container">
          <form class="form-horizontal" method="POST" action="{{url('/insertt') }}" >
             {{csrf_field()}}
              <fieldset>
                   @if(count($errors)>0)
                  @foreach($errors ->all() as $error)
                   <div class="alert alert-danger">
                       {{$error}}
                       </div> 
                  @endforeach
                 @endif
  <div class="row">
    <div class="col-md-6">
       <div class="form-group">
      <label for="exampleInputEmail1">Titre</label>
      <input  type="text" name="titre"  class="form-control" id="titre" aria-describedby="emailHelp" placeholder="titre">
      
    </div>
   
    <div class="form-group">
      <label for="exampleSelect1">Equipe</label>
        <select  name="equipe_id"  class="form-control" id="equipe_id">
            
           <option value=""></option>
            @foreach($equipes as $equipe)
            <option value="{{$equipe->id}}">{{$equipe->nom}}</option>
            @endforeach
        </select>
      
       
    </div>
      
       <div class="form-group">
      <label for="exampleSelect1">Priorité</label>
      <select type="text" name="priorite" class="form-control" id="select">
        <option>élevée</option>
        <option>moyenne</option>
        <option>faible</option>
       
      </select>
    </div>
   
    <div class="form-group">
      <label for="exampleTextarea">Durée</label>
      <input type="number" name="duree" class="form-control" id="number" aria-describedby="emailHelp" placeholder="Durée de tache">
    </div>
    </div>
    <div class="col-md-6">
     
    
      <div class="form-group">
        <label for="">adress</label>
        <input type="text" class="form-control input-sm" name="title">
      </div>

      <div class="form-group">
        <label for="">Map</label>
        <input type="text" id="searchmap">
        <div id="map-canvas"></div>
      </div>

      <div class="form-group">
        <label for="">Lat</label>
        <input type="text" class="form-control input-sm" name="lat" id="lat">
      </div>

      <div class="form-group">
        <label for="">Lng</label>
        <input type="text" class="form-control input-sm" name="lg" id="lng">
      </div>

    </div>
    
    
  </div>
   
      
       
   
   
   
    <button  type="submit" class="btn btn-primary">Ajouter</button>
       <button  type="submit" class="btn btn-primary">Annuler</button>
    <a type="submit"  href="{{ url('affichertache')}}" class="btn btn-primary">Afficher</a>
  </fieldset>
</form>

   </div>   
   
  </div>
</div>
         </div>
    
     <div class="col-lg-4">
 </div>      

    
    </div> 

    </div> 
     


<script>
  var map = new google.maps.Map(document.getElementById('map-canvas'),{
    center:{
      lat: 27.72,
          lng: 85.36
    },
    zoom:15
  });
  var marker = new google.maps.Marker({
    position: {
      lat: 27.72,
          lng: 85.36
    },
    map: map,
    draggable: true
  });
  var searchBox = new google.maps.places.SearchBox(document.getElementById('searchmap'));
  google.maps.event.addListener(searchBox,'places_changed',function(){
    var places = searchBox.getPlaces();
    var bounds = new google.maps.LatLngBounds();
    var i, place;
    for(i=0; place=places[i];i++){
        bounds.extend(place.geometry.location);
        marker.setPosition(place.geometry.location); //set marker position new...
      }
      map.fitBounds(bounds);
      map.setZoom(15);
  });
  google.maps.event.addListener(marker,'position_changed',function(){
    var lat = marker.getPosition().lat();
    var lng = marker.getPosition().lng();
    $('#lat').val(lat);
    $('#lng').val(lng);
  });
</script>