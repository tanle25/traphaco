<table class="table table-bordered">
    <thead>
      <tr>
          <th colspan="2">
            <div class="form-group row">
                <label class="col-md-2 label-form">Chọn vai trò</label>
                <select name="roles[]" class="col-md-10 form-control select2" multiple id="roles-select">
                    @foreach ($roles as $role )
                    @if ($user->hasRole($role->name))
                    <option selected value="{{$role->name}}">{{$role->name}}</option>
                    @else
                    <option value="{{$role->name}}">{{$role->name}}</option>
                    @endif
                    @endforeach
                </select>
                @error('parent_id')
                <strong class="text-red">
                    {{$message}}
                </strong>
                @enderror      
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
                  @php
                      $first_space = strpos($item->name, ' ');
                  @endphp
                  @if (substr($item->name, $first_space + 1) === $page )
                  <div class="form-check mt-1">
                        @if ($user->hasPermissionTo($item->name))
                        <input value="{{$item->name}}" checked id="permission-{{$item->id}}" name="permissions[]" class="form-check-input" type="checkbox">
                        @else
                        <input value="{{$item->name}}" id="permission-{{$item->id}}" name="permissions[]" class="form-check-input" type="checkbox">
                        @endif
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