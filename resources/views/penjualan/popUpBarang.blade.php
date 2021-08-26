<!-- Large modal -->
<div class="modal fade modal_edit" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-top modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Data Barang</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-inner">
          <table class="datatable-init table">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Harga Jual</th>
                {{-- <th>Harga Beli</th> --}}
                {{-- <th>&nbsp;</th> --}}
              </tr>
            </thead>
            <tbody>
              @php($i = 1)
              @foreach($barang as $data)
              <tr ondblclick="tambahDetail('{{$mst->NO_ENT}}','{{$data->kd_brg}}', '{{$data->nm_brg}}', '{{$data->satuan1}}', '{{$data->harga_jl}}');">
                <td>{{$i++}}</td>
                <td>{{$data->kd_brg}}</td>
                <td>{{$data->nm_brg}}</td>
                <td>{{$data->stok}}</td>
                {{-- <td>@currency($data->harga_bl)</td> --}}
                <td>@currency($data->harga_jl)</td>
                {{-- <td>
                  <div class="dropdown">
                    <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" data-offset="-8,0"><em class="icon ni ni-more-h"></em></a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                      <ul class="link-list-plain">
                        <li><a onclick="editBarang('{{$data->kd_brg}}', '{{$data->harga_jl}}')" class="text-primary" data-toggle="modal" data-target=".modal_edit">Edit</a></li>
                        <li><a href="{{url('detail_barang')}}/{{$data->kd_brg}}" class="text-primary">View</a></li>
                        <li><a href="#" class="text-danger">Remove</a></li>
                      </ul>
                    </div>
                  </div>
                </td> --}}
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>