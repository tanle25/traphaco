@php
    function mapkey($key){
      $result = '';
      switch ($key) {
        case 'fullname':
          $result = 'Họ tên';
          break;

        case 'DMS_code':
          $result = 'Mã DMS';
          break;

        case 'CRM_code':
          $result = 'Mã CRM';
          break;
        
        case 'contract_code':
          $result = 'Mã hợp đồng';
          break;

        case 'pharmacy_name':
          $result = 'Tên nhà thuốc';
          break;
        
        case 'address':
          $result = 'Địa chỉ';
          break;

        case 'phone':
          $result = 'Số điện thoại';
          break;
        
        case 'zone':
          $result = 'Địa bàn';
          break;

        case 'sale_chanel':
          $result = 'Kênh bán hàng';
          break;
      
        default:
          $result = '';
          break;
      }

      return $result;
    }
@endphp

<table class="table">
  <thead>
    <tr>
      <th>Thời gian</th>
      <th>Thao tác</th>
      <th>Người sửa</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($history_list as $item)
    @php
        $attribute = $item->properties['attributes'];
    @endphp
    <tr>
      <td>{{\Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i')}}</td>
      <td>

        @foreach ($attribute as $key => $value)
          @php
              
          @endphp
          <p>Sửa {{mapkey($key)}} thành {{$value}}</p>
        @endforeach

      </td>
      <td>
        {{$item->causer->username ?? ''}}
      </td>
    </tr>    
    @endforeach
    
  </tbody>

</table>