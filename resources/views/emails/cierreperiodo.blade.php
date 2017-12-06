@extends ('emails.layout')


@section ('contenido')

            <table cellpadding="0" cellspacing="0" border="0" align="center" width="600" class="container">
              <tr>
                <td width="100%" colspan="3" align="center" style="padding-bottom:10px;padding-top:25px;">
                  <div class="contentEditableContainer contentTextEditable">
                            <div class="contentEditable" align='center' >
                                <h2 >Informacion</h2>
                            </div>
                          </div>
                </td>
              </tr>
              <tr>
                <td width="100">&nbsp;</td>
                <td width="400" align="center">
                  <div class="contentEditableContainer contentTextEditable">
                            <div class="contentEditable" align='left' >
                                <p >Hola,{{$email->parms1}}
                                  <br/>
                                  <br/>
                        Le notificamos que el condominio <b>{{$email->parms3}}</b> se ha cerrado el periodo <b>{{$email->parms2}}</b>, para mas informacion hacer click al boton que se encuentra en la parte inferior</p>
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
                                      <a target='_blank' href="{{ENV('BASE_URL')}}emailingresosyegresos/{{$email->parms4}}/{{$email->parms5}}" class='link2'>Mas informacion</a>
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