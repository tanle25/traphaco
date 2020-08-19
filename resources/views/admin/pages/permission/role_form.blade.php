<form action="{{$url ?? route('admin.permission.store')}}" method="post">
    @csrf

    <table class="table table-bordered">
      <thead>
        <tr>
            <th colspan="2">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tên vai trò</label>
                    <div class="col-sm-10">
                        <input type="text" name="role_name" class="form-control" value="{{old('role_name')}}" placeholder="Nhập tên vai trò...">
                        @error('role_name')
                          <span class="text-red">{{$message}}</span>
                        @enderror
                      </div>

                  </div>
            </th>
        </tr>
        <tr>
          <th>
            Đối tượng
          </th>
          <th>
            Hành động
          </th>
        </tr>
      </thead>
      <tbody style="text-transform: capitalize">
        @php
          $page_list = [];

          foreach ($permissions as $item) {
            $name = $item->name;
            $pos = strpos($name, ' ');
            $page = substr($name, $pos+1);
            if (!in_array($page, $page_list)) {
              $page_list[] = $page;
            }
          }
        @endphp
        @foreach ($page_list as $page)
            <tr>
              <td>
                {{$page}}
              </td>
              <td>
                <div class="form-group">
                  @foreach ($permissions as $item)
                    @if (strpos($item, $page) !== -1 )
                    <div class="form-check mt-1">
                        <input value="{{$item->name}}" id="permission-{{$item->id}}" name="permissions[]" class="form-check-input" type="checkbox">
                        <label for="permission-{{$item->id}}" class="form-check-label">{{$item->name}}</label>
                    </div>
                    @endif
                  @endforeach
                </div>
              </td>
            </tr>
        @endforeach
      </tbody>

    </table>
    <button class="btn btn-success mt-1 float-right" type="submit">Lưu</button>
  </form>