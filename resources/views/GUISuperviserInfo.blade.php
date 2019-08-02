
<table width="50%" class="prevForms">
        <thead>
          <tr>
            <th>
              تعديل
            </th>
            <th>
              البرنامج
            </th>
            <th>
             البريد الالكنروني
            </th>
            <th>
              الاسم
            </th>
            <th>
              الرقم التعريفي
            </th>
          </tr>
        </thead>
        <tbody>
        @if(isset($supervisers))
         @foreach($supervisers as $superviser)
          <tr>
            <td>
            <form action='/edit' method='post'>
            {{ csrf_field() }}
            <input type="hidden" value="{{$superviser->id}}" name="superviser_id">
              <button type="submit" class="editBtn"><embed type="image/svg+xml" src="/images/edit-3.svg" /></button>
            </form>
            </td>
            @if(isset($programs[$superviser->id]))
            <td>
              {{$programs[$superviser->id]->name}}
            </td>
            @else
            <td>
            </td>
            @endif
            <td>
            {{$superviser->email}}
            </td>
            <td>
            {{$superviser->f_name}}  {{$superviser->s_name}} {{$superviser->l_name}}
            </td>
            <td>
             {{$superviser->id}}
            </td>
          </tr>
          @endforeach
          @endif
        </tbody>

      </table>

      </table>
