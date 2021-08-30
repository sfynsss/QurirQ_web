@extends('layouts.app')

@section('content')

<div class="nk-block nk-block-lg">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Master Outlet</h3>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <button class="btn btn-primary" data-toggle="modal" data-target=".modal_input" onclick="setOutlet();">Tambah</button> 
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    
    <div class="modal fade modal_input" id="modalku" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <form action="{{url('/simpan_outlet')}}" method="post" id="link_url" name="link_url" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Form Outlet</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="card-inner">
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="full-name-1">Kategori Outlet</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" value="{{ $kategori->nm_kategori_outlet }}" readonly>
                                            <input type="text" class="form-control" value="{{ $kategori->id }}" name="id_kategori_outlet" hidden readonly>
                                            <input type="text" class="form-control" id="id_outlet" name="id_outlet" hidden readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="full-name-1">Nama Outlet</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" placeholder="Nama Outlet" id="nama_outlet" name="nama_outlet">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="email-address-1">Keterangan</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" placeholder="Keterangan" id="keterangan" name="keterangan">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Status Aktif</label>
                                        <ul class="custom-control-group g-3 align-center">
                                            <li>
                                                <div class="custom-control custom-control-sm custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="status" name="status" value="1">
                                                    <label class="custom-control-label" for="status">Aktif</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="email-address-1">Alamat Outlet</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" placeholder="Alamat" id="alamat" name="alamat">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="email-address-1">Pilih Gambar Outlet</label>
                                        <div class="form-control-wrap">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile" name="gambar_outlet" accept=".jpg, .jpeg, .png" >
                                                <label class="custom-file-label" for="customFile">Pilih Gambar</label>
                                            </div>
                                            <p>*ukuran file maksimal 100kb</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-label" for="full-name-1">Cari Lokasi</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" id="searchInput" placeholder="Masukan Lokasi">
                                            <input type="text" class="form-control" id="lat" name="lat" hidden readonly>
                                            <input type="text" class="form-control" id="long" name="long" hidden readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="col-lg-12">
                                <div id="googleMap" style="height: 400px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect text-left">Close</button>
                        <button type="submit" class="btn btn-success waves-effect text-left">Submit</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    
    <div class="card card-bordered card-preview">
        <table class="table table-orders">
            <thead class="tb-odr-head">
                <tr class="tb-odr-item">
                    <th>No</th>
                    <th>Nama Outlet</th>
                    <th>Keterangan</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Gambar Outlet</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="tb-odr-body">
                @foreach($data as $i => $data)
                <tr class="tb-odr-item">
                    <td>{{$i+1}}</td>
                    <td>{{$data->nama_outlet}}</td>
                    <td>{{$data->keterangan}}</td>
                    <td>{{$data->alamat}}</td>
                    @if($data->status == 1)
                    <td>Aktif</td>
                    @else
                    <td>Tidak Aktif</td>
                    @endif
                    <td>
                        @if($data->gambar_outlet == "")
                        <span class="badge badge-danger">Data Kosong</span>
                        @else
                        <img src="{{asset('storage')}}/{{$data->gambar_outlet}}" width="100" height="100">
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
							<a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" data-offset="-8,0"><em class="icon ni ni-more-h"></em></a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
								<ul class="link-list-plain">
									<li><a data-toggle="modal" data-target=".modal_input" onclick="ubahOutlet('{{$data->id}}', '{{$data->nama_outlet}}', '{{$data->keterangan}}', '{{$data->status}}', '{{$data->alamat}}', '{{$data->lat}}', '{{$data->long}}');">Edit</a></li>
									<li><a href="{{route('data_barang', $data->id)}}" class="text-primary">Barang</a></li>
									<li><a href="{{route('hapus_outlet', $data->id)}}" onclick="if (confirm('Delete selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};" class="text-danger">Remove</a></li>
								</ul>
							</div>
						</div>
                        {{-- <a href="{{route('hapus_outlet', $data->id)}}" onclick="if (confirm('Delete selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};"><button type="submit" class="btn btn-danger">Hapus</button></a> --}}
                        {{-- <a href="{{url('detailOutlet/')}}/{{$data->kd_outlet}}"><button type="submit" class="btn btn-success">Detail</button></a> --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div><!-- .card-preview -->
</div><!-- nk-block -->

@endsection

@section('script')
<script>
    function setOutlet() {
        $('#link_url').attr('action', '{{route('simpan_outlet')}}');
        $("#nama_outlet").val("");
        $("#keterangan").val("");
        $("#alamat").val("");
        $("#gambar_outlet").val("");
        $('#status').removeAttr('checked');

        initMap(-8.16918334514732,113.70229443588259); 
    }  

    function initMap($a, $b){
        var myLatlng = new google.maps.LatLng($a, $b);
        var mapProp = {
            center:myLatlng,
            zoom:15,
            mapTypeId:google.maps.MapTypeId.ROADMAP
            
        };

        var map=new google.maps.Map(document.getElementById("googleMap"), mapProp);
        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: 'Hello World!',
            draggable:true  
        });

        var input = document.getElementById('searchInput');
        // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        autocomplete.addListener('place_changed', function(){
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if(!place.geometry){
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }

            if(place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }

            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

            document.getElementById('lat').value = place.geometry.location.lat();
            document.getElementById('long').value = place.geometry.location.lng();
        });
        
        document.getElementById('lat').value= -8.16918334514732
        document.getElementById('long').value= 113.70229443588259
        // marker drag event
        google.maps.event.addListener(marker,'drag',function(event) {
            document.getElementById('lat').value = event.latLng.lat();
            document.getElementById('long').value = event.latLng.lng();
        });
        
        //marker drag event end
        google.maps.event.addListener(marker,'dragend',function(event) {
            document.getElementById('lat').value = event.latLng.lat();
            document.getElementById('long').value = event.latLng.lng();
        });
        
        google.maps.event.addListener(map, 'click', function(event) {
            document.getElementById("lat").value = event.latLng.lat();
            document.getElementById("long").value = event.latLng.lng();
            marker.setPosition(event.latLng);
        });
    }
    
    google.maps.event.addDomListener(window, 'load', setOutlet);
    
    function ubahOutlet($a, $b, $c, $d, $e, $lat, $long) {
        $('#link_url').attr('action', '{{route('ubah_outlet')}}');
        $("#id_outlet").val($a);
        $("#nama_outlet").val($b);
        $("#keterangan").val($c);
        if ($d == 1) {
            $('#status').attr('checked', 'checked');
        } else {
            $('#status').removeAttr('checked');
        }
        $("#alamat").val($e);

        initMap($lat, $long);
        
    }
    
    var uploadField = document.getElementById("customFile");
    
    uploadField.onchange = function() {
        if(this.files[0].size > 100000){
            alert("File is too big!");
            this.value = "";
        };
    };
    
    
</script>
@endsection