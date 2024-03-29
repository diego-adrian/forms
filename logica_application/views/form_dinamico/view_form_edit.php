<script type="text/javascript">
  const formId = 1;
  var globalFormio;
  const keys = (object) => {
    return new Promise((resolve, reject) => {
      try {
        const settings = {
          readonly: object.disabled,
          required: object.validate.required,
          label: object.label,
          description: object.tooltip,
          name: object.attributes ? object.attributes.name : ''
        };
        switch (object.type) {
          case 'htmlelement':
            resolve(Object.assign(settings, {
              form_id: formId,
              type: 'header'
            }));
            break;
          case 'textfield':
            resolve(Object.assign(settings, {
              form_id: formId,
              type: 'text',
              placeholder: object.placeholder,
              defaultValue: object.defaultValue,
              subtype: 'text',
              maxlength: object.validate ? object.validate.maxLength : 100,
              className: object.customClass
            }));
            break;
          case 'password':
            resolve(Object.assign(settings, {
              form_id: formId,
              type: 'text',
              placeholder: object.placeholder,
              defaultValue: object.defaultValue,
              subtype: 'password',
              maxlength: object.validate ? object.validate.maxLength : 100,
              className: object.customClass
            }));
            break;
          case 'email':
            resolve(Object.assign(settings, {
              form_id: formId,
              type: 'text',
              placeholder: object.placeholder,
              defaultValue: object.defaultValue,
              subtype: 'email',
              maxlength: object.validate ? object.validate.maxLength : 100,
              className: object.customClass
            }));
            break;
          case 'number':
            resolve(Object.assign(settings, {
              form_id: formId,
              type: 'number',
              placeholder: object.placeholder,
              defaultValue: object.defaultValue,
              max: object.validate ? object.validate.max : 10,
              min: object.validate ? object.validate.min : 1,
              className: object.customClass
            }));
            break;
          case 'datetime':
            resolve(Object.assign(settings, {
              form_id: formId,
              type: 'date',
              subtype: object.format === 'dd/MM/yyyy' ? 'date' : 'time',
              placeholder: object.placeholder,
              defaultValue: object.defaultValue
            }));
            break;
          case 'select':
            resolve(Object.assign(settings, {
              form_id: formId,
              type: 'select',
              placeholder: object.placeholder,
              values: object.data ? object.data.json : []
            }));
            break;
          case 'radio':
            resolve(Object.assign(settings, {
              form_id: formId,
              type: 'radio-group',
              description: object.tooltip,
              values: object.values
            }));
            break;
          case 'selectboxes':
            resolve(Object.assign(settings, {
              form_id: formId,
              type: 'checkbox-group',
              values: object.values
            }));
            break;
          case 'textarea':
            resolve(Object.assign(settings, {
              form_id: formId,
              type: 'textarea',
              subtype: 'textarea',
              placeholder: object.placeholder,
              rows: object.rows,
              maxlength: object.validate ? object.validate.maxLength : 250
            }));
            break;
        }
      } catch (err) {
        reject(err.message);
      }
    })
  };
  const generateJSON = (data, json) => {
    return new Promise((resolve, reject) => {
      try {
        const promises = [];
        for (let component of json.filter(item => item.type !== 'button')) {
          promises.push(keys(component));
        }
        Promise.all(promises)
          .then(response => {
            const sendData = {
              codigo_registro: 10,
              form_id: formId,
              form_detalle: 'Formulario A',
              tipo_bandeja: 1,
              lista_elementos: response 
            }
            resolve(sendData);
          });

      } catch (err) {
        reject(err);
      }
    })
  };
  <?php echo $strValidacionJqValidate; ?>
    Elementos_Habilitar_ObjetoARefComoSubmit("btnGuardarFormulario", "FormularioCampos");
    Ajax_DarActualizarValidacionEnvioAjaxSegmentoForm("FormularioCampos", 'Formulario/Nuevo/Guardar', 'divVistaMenuPantalla', 'divErrorListaResultado');

    $("#divCargarFormulario").show();    
    $("#confirmacion").hide();

    function MostrarConfirmación()
    {
        $("#divCargarFormulario").hide();
        $("#confirmacion").fadeIn(500);
        globalFormio.then((res) => {
          $('#json_stringify_formio').val(JSON.stringify(res.components.map(item => item.component)));
          return generateJSON([], res.components.map(item => item.component));
        })
        .then((data) => {
          $('#json_stringify_formatted').val(JSON.stringify(data));
        })
    }
    
    function OcultarConfirmación()
    {
        $("#divCargarFormulario").fadeIn(500);    
        $("#confirmacion").hide();
    }
    
    $("#conf_correo_smtp_pass").attr("type", "password");
    
    function MostrarOcultarPass()
    {
        if ($("#conf_correo_smtp_pass").attr("type") == "password") {
            $("#conf_correo_smtp_pass").attr("type", "text");
        } else {
            $("#conf_correo_smtp_pass").attr("type", "password");
        }
    }

</script>
  <script>
    const espaniol = {
      Submit: 'Enviar',
      Language: 'Idioma',
      Translations: 'Traducciones',
      'First Name': 'Tu nombre',
      'Last Name': 'Apellido',
      'Text Field': 'Campo de texto',
      'Text Area': 'Parrafo',
      Email: 'Correo electrónico',
      'Phone Number': 'Número telefónico',
      Save: 'Guardar',
      Remove: 'Borrar',
      Cancel: 'Cancelar',
      Preview: 'Vista previa',
      Help: 'Ayuda',
      Display: 'Vista',
      Data: 'Datos',
      Validation: 'Validaciones',
      API: 'API',
      Tooltip: 'Description',
      Conditional: 'Condicionales',
      Logic: 'Logica',
      Layout: 'Atributos',
      Date: 'Fecha',
      Time: 'Hora',
      minLength: 'Faltan caracteres para {{field}}',
      maxLength: '{{field}} excede la cantidad permitida de caracteres',
      'Custom CSS Class': 'ClassName',
      'To add a tooltip to this field, enter text here.': 'Desea agregar alguna descripción',
      'Enter your email address': 'Ingrese su dirección de correo electrónico',
      'Enter your first name': 'Ponga su primer nombre',
      'Drag and Drop a form component': 'Arrastra y suelta en esta sección un campo de formulario',
      'Enter your last name': 'Ingresa tu apellido',
      'Valid Email Address': 'dirección de email válida',
      'Please correct all errors before submitting.': 'Por favor, corrija todos los errores antes de enviar.',
      required: '{{field}} es requerido.',
      invalid_email: '{{field}} debe ser un correo electrónico válido.',
      error: 'Por favor, corrija los siguientes errores antes de enviar.'
    };
    $(document).ready(() => {

      // CREANDO EL COMPONENTE MAPA
      var BaseComponent = Formio.Components.components.base;

      /**
       * @param component
       * @param options
       * @param data
       * @constructor
       */
      function Maps(component, options, data) {
        BaseComponent.prototype.constructor.call(this, component, options, data);
      }

      // Perform typical ES5 inheritance
      Maps.prototype = Object.create(BaseComponent.prototype);
      Maps.prototype.constructor = Maps;

      /**
       * Define what the default JSON schema for this component is. We will derive from the BaseComponent
       * schema and provide our overrides to that.
       * @return {*}
       */
      Maps.schema = function() {
        return BaseComponent.schema({
          type: 'maps',
          numRows: 3,
          numCols: 3
        });
      };

      /**
       * Register this component to the Form Builder by providing the "builderInfo" object.
       * 
       * @type {{title: string, group: string, icon: string, weight: number, documentation: string, schema: *}}
       */
      Maps.builderInfo = {
        title: 'Maps',
        group: 'basic',
        icon: 'fa fa-table',
        weight: 70,
        documentation: 'http://help.form.io/userguide/#table',
        schema: Maps.schema()
      };

      /**
       *  Tell the renderer how to build this component using DOM manipulation. 
       */
      Maps.prototype.build = function() {
        this.element = this.ce('div');
        this.createLabel(this.element);

        // Creando el component mapa con leaflet
        var map = this.ce('div', {
          id: 'miMapa',
          style: 'width: 600px; height: 400px;'
        });
        
        document.getElementById('formio').appendChild(map);

        var mymap = L.map('miMapa').setView([51.505, -0.09], 13);

        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
          maxZoom: 18,
          attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
          id: 'mapbox.streets'
        }).addTo(mymap);
        this.element.appendChild(map);
      };

      /**
       * Provide the input element information. Because we are using checkboxes, the change event needs to be 
       * 'click' instead of the default 'change' from the BaseComponent.
       * 
       * @return {{type, component, changeEvent, attr}}
       */
      Maps.prototype.elementInfo = function() {
        const info = BaseComponent.prototype.elementInfo.call(this);
        info.changeEvent = 'click';
        return info;
      };

      /**
       * Tell the renderer how to "get" a value from this component.
       * 
       * @return {Array}
       */
      Maps.prototype.getValue = function() {
        var value = [];
        for (var rowIndex in this.checks) {
          var row = this.checks[rowIndex];
          value[rowIndex] = [];
          for (var colIndex in row) {
            var col = row[colIndex];
            value[rowIndex][colIndex] = !!col.checked;
          }
        }
        return value;
      };

      /**
       * Tell the renderer how to "set" the value of this component.
       * 
       * @param value
       * @return {boolean}
       */
      Maps.prototype.setValue = function(value) {
        if (!value) {
          return;
        }
        for (var rowIndex in this.checks) {
          var row = this.checks[rowIndex];
          if (!value[rowIndex]) {
            break;
          }
          for (var colIndex in row) {
            var col = row[colIndex];
            if (!value[rowIndex][colIndex]) {
              return false;
            }
            let checked = value[rowIndex][colIndex] ? 1 : 0;
            col.value = checked;
            col.checked = checked;
          }
        }
      };

      // Use the table component edit form.
      Maps.editForm = Formio.Components.components.table.editForm;

      // Register the component to the Formio.Components registry.
      Formio.Components.addComponent('maps', Maps);

      // TERMINA AQUI EL COMPONENTE MAPA


      globalFormio = Formio.builder(document.getElementById('formio'), {
        components: []
      }, {
        reandOnly: false,
        language: 'en',
        // i18n: {
        //   'es': espaniol
        // },
        builder: {
          basic: false,
          advanced: false,
          data: false,
          layout: false,
          custom: {
            title: 'Campos de formulario',
            weight: 0,
            components: {
              header: {
                title: 'Título',
                key: 'titulo',
                schema: {
                  label: 'Título',
                  type: 'htmlelement',
                  key: 'titulo',
                  content: '<h1>Título</h1>'
                }
              },
              textField: {
                title: 'Campo de texto',
                key: 'campo-texto',
                schema: {
                  label: 'Campo de texto',
                  type: 'textfield',
                  key: 'campo-texto',
                  placeholder: 'Ingrese texto',
                  defaultValue: '',
                  attributes: {
                    id: 'uno'
                  }
                }
              },
              password: {
                title: 'Contraseña',
                key: 'contrasenia',
                schema: {
                  label: 'Contraseña',
                  type: 'password',
                  key: 'contrasenia',
                  placeholder: 'Ingrese contraseña',
                  defaultValue: '',
                  attributes: {
                    id: 'dos'
                  }
                }
              },
              email: {
                title: 'Correo electronico',
                key: 'email',
                schema: {
                  label: 'Correo electronico',
                  type: 'email',
                  key: 'email',
                  placeholder: 'Ingrese un correo electronico',
                  defaultValue: '',
                  attributes: {
                    id: 'tres'
                  }
                }
              },
              textArea: {
                title: 'Parrafo',
                key: 'parrafo',
                schema: {
                  label: 'Parrafo',
                  type: 'textarea',
                  key: 'parrafo',
                  placeholder: 'Ingrese algun parrafo',
                  defaultValue: ''
                }
              },
              number: {
                title: 'Numérico',
                key: 'numerico',
                schema: {
                  label: 'Campo numérico',
                  type: 'number',
                  key: 'numerico',
                  placeholder: 'Valor numérico',
                  defaultValue: 0
                }
              },
              dateField: {
                title: 'Fecha',
                key: 'fecha',
                schema: {
                  label: 'Fecha',
                  type: 'datetime',
                  key: 'fecha',
                  format: 'dd/MM/yyyy',
                  enableTime: false,
                  placeholder: 'Ingrese una fecha',
                  defaultValue: ''
                }
              },
              timeField: {
                title: 'Hora',
                key: 'hora',
                schema: {
                  label: 'Hora',
                  type: 'datetime',
                  key: 'hora',
                  format: 'hh:mm a',
                  enableDate: false,
                  placeholder: 'Ingrese una hora',
                  defaultValue: ''
                }
              },
              select: {
                title: 'Lista desplegable',
                key: 'select',
                schema: {
                  label: 'Lista opciones',
                  type: 'select',
                  key: 'select',
                  placeholder: 'Seleccione una opción',
                  searchEnabled: false,
                  limit: 1000,
                  defaultValue: ''
                }
              },
              radio: {
                title: 'Opciones',
                key: 'radio',
                schema: {
                  label: 'Opciones excluyentes',
                  type: 'radio',
                  key: 'radio',
                  defaultValue: ''
                }
              },
              selectboxes: {
                title: 'Selección multiple',
                key: 'seleccion-multiple',
                schema: {
                  label: 'Selección multiple',
                  type: 'selectboxes',
                  key: 'seleccion-multiple',
                  defaultValue: ''
                }
              },
              firmaElectronica: {
                title: 'Firma electrónica',
                key: 'firma-electronica',
                schema: {
                  label: 'firma electrónica',
                  type: 'file',
                  key: 'firma-electronica',
                  defaultValue: '',
                  image: true,
                  storage: 'base64',
                  webcam: false,
                  imageSize: '5MB',
                  fileTypes: [
                    {
                      label: '',
                      value: ''
                    }
                  ]
                }
              },
              mapa: {
                title: 'Mapa',
                key: 'mapa',
                schema: {
                  label: 'Mapa',
                  type: 'maps',
                  key: 'mapa',
                  defaultValue: ''
                }
              }
            }
          }
        },
        editForm: {
          textfield: [
            {
              key: 'display',
              ignore: false
            },
            {
              key: 'api',
              ignore: true
            },
            {
              key: 'conditional',
              ignore: true
            },
            {
              key: 'logic',
              ignore: true
            },
            {
              key: 'layout',
              ignore: true
            }
          ],
          password: [
            {
              key: 'api',
              ignore: true
            },
            {
              key: 'conditional',
              ignore: true
            },
            {
              key: 'logic',
              ignore: true
            },
            {
              key: 'layout',
              ignore: true
            }
          ],
          email: [
            {
              key: 'api',
              ignore: true
            },
            {
              key: 'conditional',
              ignore: true
            },
            {
              key: 'logic',
              ignore: true
            },
            {
              key: 'layout',
              ignore: true
            }
          ],
          textarea: [
            {
              key: 'api',
              ignore: true
            },
            {
              key: 'conditional',
              ignore: true
            },
            {
              key: 'logic',
              ignore: true
            },
            {
              key: 'layout',
              ignore: true
            }
          ],
          htmlelement: [
            {
              key: 'api',
              ignore: true
            },
            {
              key: 'data',
              ignore: true
            },
            {
              key: 'conditional',
              ignore: true
            },
            {
              key: 'logic',
              ignore: true
            },
            {
              key: 'layout',
              ignore: true
            }
          ],
          number: [
            {
              key: 'api',
              ignore: true
            },
            {
              key: 'conditional',
              ignore: true
            },
            {
              key: 'logic',
              ignore: true
            },
            {
              key: 'layout',
              ignore: true
            }
          ],
          datetime: [
            {
              key: 'api',
              ignore: true
            },
            {
              key: 'conditional',
              ignore: true
            },
            {
              key: 'logic',
              ignore: true
            },
            {
              key: 'layout',
              ignore: true
            }
          ],
          radio: [
            {
              key: 'api',
              ignore: true
            },
            {
              key: 'conditional',
              ignore: true
            },
            {
              key: 'logic',
              ignore: true
            },
            {
              key: 'layout',
              ignore: true
            }
          ],
          selectboxes: [
            {
              key: 'api',
              ignore: true
            },
            {
              key: 'conditional',
              ignore: true
            },
            {
              key: 'logic',
              ignore: true
            },
            {
              key: 'layout',
              ignore: true
            }
          ],
          file: [
            {
              key: 'api',
              ignore: true
            },
            {
              key: 'conditional',
              ignore: true
            },
            {
              key: 'logic',
              ignore: true
            },
            {
              key: 'layout',
              ignore: true
            }
          ],
          button: [
            {
              key: 'api',
              ignore: true
            },
            {
              key: 'data',
              ignore: true
            },
            {
              key: 'conditional',
              ignore: true
            },
            {
              key: 'logic',
              ignore: true
            },
            {
              key: 'layout',
              ignore: true
            }
          ],
          select: [
            {
              key: 'api',
              ignore: true
            },
            {
              key: 'conditional',
              ignore: true
            },
            {
              key: 'logic',
              ignore: true
            },
            {
              key: 'layout',
              ignore: true
            }
          ]
        }
      }).then(function(builder) {
        // Evita que el envío vaya al servidor
        builder.nosubmit = true;
        if (!builder.collapsed) {
          builder.toggleCollapse();
          builder.groups.custom.panel.className = 'panel-collapse collapse in show';
        }
        builder.on('submit', () => {
          builder.emit('submitDone', true);
        });
        return builder;
      });
    });
  	</script>
<div id="divVistaMenuPantalla" align="center">

    <div id="divCargarFormulario" class="TamanoContenidoGeneral">

        <br /><br />

        <div class="FormularioSubtituloImagenNormal" style="background: url(html_public/imagenes/logo_initium.png) no-repeat; background-size: contain; background-position: center;"> </div>

            <div class="FormularioSubtitulo"> <?php echo $this->lang->line('FormularioDinamicoTitulo'); ?></div>
            <div class="FormularioSubtituloComentarioNormal "><?php echo $this->lang->line('FormularioDinamicoSubtitulo'); ?></div>
        
        <div style="clear: both"></div>        
        
        <br />

        <div id='formio'></div>
        <form id="FormularioCampos" method="post">
          <input type="hidden" name="json_stringify_formatted" id="json_stringify_formatted" value="" />
          <input type="hidden" name="json_stringify_formio" id="json_stringify_formio" value="" />
        </form>

        <br /><br /><br />

        <div class="Botones2Opciones">
            <a onclick="Ajax_CargarOpcionMenu('Formularios/Ver');" class="BotonMinimalista"> <?php echo $this->lang->line('BotonCancelar'); ?> </a>
        </div>

        <div class="Botones2Opciones">
            <a onclick="MostrarConfirmación();" class="BotonMinimalista"> <?php echo $this->lang->line('BotonAceptar'); ?> </a>
        </div>
        
        <div style="clear: both"></div>

    </div>
    
    <div id="confirmacion" class="PreguntaConfirmacion TamanoContenidoGeneral">

        <div class="FormularioSubtituloImagenPregunta"> </div>

            <div class="PreguntaTitulo"> <?php echo $this->lang->line('PreguntaTitulo'); ?></div>
            <div class="PreguntaTexto "><?php echo $this->lang->line('conf_formulario_insertar'); ?></div>

            <div style="clear: both"></div>

            <br />

        <div class="PreguntaConfirmar">
            <?php echo $this->lang->line('PreguntaContinuar'); ?>
        </div>

        <div class="Botones2Opciones">
            <a onclick="OcultarConfirmación();" class="BotonMinimalista"> <?php echo $this->lang->line('BotonCancelar'); ?> </a>
        </div>

        <div class="Botones2Opciones">
            <a id="btnGuardarFormulario" class="BotonMinimalista"> <?php echo $this->lang->line('BotonAceptar'); ?> </a>
        </div>

        <div style="clear: both"></div>

		<br />

        <?php if (isset($respuesta)) { ?>
            <div class="mensajeBD"> 
                <div style="padding: 15px;">
                    <?php echo $respuesta ?>
                </div>
            </div>
        <?php } ?>

        <div id="divErrorListaResultado" class="mensajeBD"> </div>

    </div>
</div>