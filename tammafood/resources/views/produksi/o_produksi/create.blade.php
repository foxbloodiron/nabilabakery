  <td>Nomor SPK</td>
  <td>
    <select class="form-control" id="mySelect" onchange="SetItem()">
      @if(count($dataSpk) <=0)
        <option value=""> --Tidak ada SPK-- </option>
      @elseif(count($dataSpk) >0)
        <option value=""> --Pilih SPK-- </option>
        @foreach ($dataSpk as $data)
        <option data-id="{{ $data->spk_id }}" data-iditem="{{ $data->spk_item }}" data-namaitem="{{ $data->i_name }}" id="{{$data->spk_id}}" value="{{$data->spk_id}}">
          {{ $data->spk_code }}
        </option>
        @endforeach
      @endif
    </select>
  </td>