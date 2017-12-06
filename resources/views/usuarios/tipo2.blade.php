

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
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    {!!Form::submit($button,['class'=>'btn btn-success'])!!}
                </div>
            </div>
     
    {!!Form::close()!!}
