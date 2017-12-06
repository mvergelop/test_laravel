@extends ('emails.layout')


@section ('contenido')

            <table cellpadding="0" cellspacing="0" border="0" align="center" width="600" class="container">
              <tr>
                <td width="100%" colspan="3" align="center" style="padding-bottom:10px;padding-top:25px;">
                  <div class="contentEditableContainer contentTextEditable">
                            <div class="contentEditable" align='center' >
                                <h2 >Contacto Netus</h2>
                            </div>
                          </div>
                </td>
              </tr>
              <tr>
                <td width="100">&nbsp;</td>
                <td width="400" align="center">
                  <div class="contentEditableContainer contentTextEditable">
                            <div class="contentEditable" align='left' >
                                <p >Hola,<b> Contacto Netus </b> se ha recibido un correo del formulario de contacto del sitio web.  
                                  <br/>
                                  <br/>
                                Fecha : {{$email->created_at}} <br>
                                De : <b>{{$email->parms1}}</b> - <b>{{$email->para}}</b> <br>
                                Asunto : <b>{{$email->asunto}}</b> <br>
                                Mensaje : <b>{{$email->mensaje}}</b> <br>

                        
                            </div>
                          </div>
                </td>
                <td width="100">&nbsp;</td>
              </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" align="center" width="600" class="container">
              <tr>
                <td width="200">&nbsp;</td>
                <td width="200" align="center" style="padding-top:25px;">
                 
                </td>
                <td width="200">&nbsp;</td>
              </tr>
            </table>


@stop 