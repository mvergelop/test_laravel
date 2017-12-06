
            {!!Form::open(['url'=>$action, 'method'=>$method,'class' => 'form-horizontal form-label-left'])!!}
              
              <div style="display: none;">
                <input type="hidden" name="id" value ="{{$user->id}}" id= 'id'>

                  <div class="form-group">
                      {!!Form::label('login','Usuario:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                                      
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <input class="form-control" name="login" type="text" id="login"    

                            @if (!empty(old('login')))
                                value = "{{old('login')}}"
                            @else
                                value = "{{$user->login}}"
                            @endif 

                            @if (isset($user->login))
                              readonly
                            @endif >
                          
                      </div>
                  </div>
              </div>

                <div class="form-group">
                    {!!Form::label('nombre','Nombre del Condominio:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                                    
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input class="form-control" name="name" type="text" id="name"   
                        @if (!empty(old('login')))
                            value = "{{old('name')}}"
                        @else
                            value = "{{$user->name}}"
                        @endif  >
                    </div>
                </div>

                <div class="form-group">
                    {!!Form::label('correo','Correo del Condominio:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                                    
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input class="form-control" name="email" type="text" 
                          @if (!empty(old('login')))
                              value = "{{old('email')}}"
                          @else
                              value = "{{$user->email}}"
                          @endif
                          id="email"
                          @if (isset($user->login))
                            readonly
                          @endif >
                    </div>
                </div>
                <div class="form-group">
                    {!!Form::label('lb_tipocuenta','Tipo Cuenta:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" value name="tipo" id="tipo">
                            @if (!isset($user->tipo))
                                <option value="1">Administrador</option>
                                <option value="2" selected>Operador</option>
                            @else 
                                <option value="1" @if ($user->tipo =='1') selected @endif>Administrador</option>
                                <option value="2" @if ($user->tipo =='2') selected @endif>Operador</option>
                            @endif 
                        </select>
                    </div>
                </div>
                <div class="form-group">
                  {!!Form::label('lb_licencia','Licencia:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    @if (Auth::user()->tipo=='2')
                      <input type="hidden" name="tipo_licencia" value ="{{$user->tipo}}" id= 'tipo_licencia'>
                      @if ($user->tipo_licencia =='1')
                        <input type="text" name="tipo_licencia_2" id="vencimiento" class="form-control" value ="Gratuita" readonly>
                      @else 
                        <input type="text" name="tipo_licencia_2" id="vencimiento" class="form-control" value ="Premiun" readonly>
                      @endif 
                    @else

                      <select class="form-control" name="tipo_licencia" id="tipo_licencia">
                          @if (!isset($user->tipo))

                            <option value="1" selected>Licencia 1</option>
                            <option value="2">Licencia 2</option>
                            <option value="3">Licencia 3</option>
                            <option value="4">Licencia 4</option>
                            <option value="5">Licencia 5</option>
                            <option value="6">Licencia 6</option>
                          @else 
                            <option value="1" @if ($user->tipo_licencia =='1') selected @endif>Licencia 1</option>
                            <option value="2" @if ($user->tipo_licencia =='2') selected @endif>Licencia 2</option>
                            <option value="3" @if ($user->tipo_licencia =='3') selected @endif>Licencia 3</option>
                            <option value="4" @if ($user->tipo_licencia =='4') selected @endif>Licencia 4</option>
                            <option value="5" @if ($user->tipo_licencia =='5') selected @endif>Licencia 5</option>
                            <option value="6" @if ($user->tipo_licencia =='6') selected @endif>Licencia 6</option>
                          @endif 
                      </select>
                    @endif  
                  </div>
                </div>
                
                
                <div class="form-group">
                  {!!Form::label('lb_vencimiento','Fecha Vencimiento:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                  <div class="col-md-2 col-sm-2 col-xs-6">
                      <div class="input-group date" >
                        <input type="text" class="form-control" name ='vencimiento' id="vencimiento" data-date-format="dd/mm/yyyy">
                        <div class="input-group-addon">
                          <span class="glyphicon glyphicon-th"></span>
                        </div>
                      </div>
                    
                  </div>
                </div>

                <div @if (isset($user->login)) style="display: none;" @endif >
                  <div class="form-group">
                      {!!Form::label('password','Contraseña:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          {!!Form::password('password',array('class'=>'form-control col-md-7 col-xs-12'))!!}
                      </div>
                  </div>

                  <div class="form-group">
                      {!!Form::label('password2','Repetir Contraseña:',['class' =>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          {!!Form::password('password2',array('class'=>'form-control col-md-7 col-xs-12'))!!}
                      </div>
                  </div>
                </div>
                
                 <div class="form-group">
                  {!!Form::label('activo','Correo Confirmado:',['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="checkbox checkbox-success" style="margin-top: 0;margin-bottom: 0">
                          <input type="checkbox" name="confirm" value="1" @if ($user->confirm == 1) checked @endif class="styled" readonly>
                          <label></label>
                      </div>
                  </div>
              </div>

              <div class="form-group">
                  {!!Form::label('activo','Activo:',['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="checkbox checkbox-success" style="margin-top: 0;margin-bottom: 0">
                          <input type="checkbox" name="activo" value="1" @if ($user->activo == 1) checked @endif class="styled" readonly>
                          <label></label>
                      </div>
                  </div>
              </div>

                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        {!!Form::submit($button,['class'=>'btn btn-success'])!!}
                    </div>
                </div>
         
        {!!Form::close()!!}
       
