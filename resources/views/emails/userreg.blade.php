@extends ('emails.layout')


@section ('contenido')

            <table cellpadding="0" cellspacing="0" border="0" align="center" width="600" class="container">
              <tr>
                <td width="100%" colspan="3" align="center" style="padding-bottom:10px;padding-top:25px;">
                  <div class="contentEditableContainer contentTextEditable">
                            <div class="contentEditable" align='center' >
                                <h2 >Bienvenido</h2>
                            </div>
                          </div>
                </td>
              </tr>
              <tr>
                <td width="100">&nbsp;</td>
                <td width="400" align="center">
                  <div class="contentEditableContainer contentTextEditable">
                            <div class="contentEditable" align='left' >
                                <p >Hola,{{$usuario->name}}
                                  <br/>
                                  <br/>
                        Gracias por registrace en netus.com.ve, para activar y hacer uso de su cuenta netus debe hacer click en el boton que se encuentra abajo</p>
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
                  <table cellpadding="0" cellspacing="0" border="0" align="center" width="200" height="50">
                    <tr>
                      <td bgcolor="#2A3F54" align="center" style="border-radius:4px;" width="200" height="50">
                        <div class="contentEditableContainer contentTextEditable">
                                  <div class="contentEditable" align='center' >
                                      <a target='_blank' href="{{ENV('BASE_URL')}}/activate/{{$usuario->confirmation_code}}" class='link2'>Activar cuenta</a>
                                  </div>
                                </div>
                      </td>
                    </tr>
                  </table>
                </td>
                <td width="200">&nbsp;</td>
              </tr>
            </table>


@stop 