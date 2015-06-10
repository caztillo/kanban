<?php

class BeneficiariosController extends \BaseController {

	/**
	 * Display a listing of beneficiarios
	 *
	 * @return Response
	 */
	public function index()
	{
		//$beneficiarios = Beneficiario::all();
        $beneficiarios = Beneficiario::orderBy('creacion', 'desc')->simplePaginate(Config::get("constantes.elementos_pagina"));
		return View::make('beneficiarios.index', compact('beneficiarios'));
	}

	/**
	 * Show the form for creating a new beneficiario
	 *
	 * @return Response
	 */
	public function create()
	{
		$paises = $this->paises(); 

		return View::make('beneficiarios.create', compact('paises'));
	}

	/**
	 * Store a newly created beneficiario in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        Input::merge(array_map('trim', Input::all()));
        $paises = base64_encode(serialize($this->paises()));

        $rules = [
            'nombre' => 'required|alpha_space|between:2,255',
            'direccion' => 'required|between:1,255',
            'codigo_postal' => 'required|digits:5',
            'telefono' => array('required','regex:/^[0-9]{10,20}$/'),
            'correo' => 'required|email',
            'fecha_nacimiento' => 'required|date|date_format:"Y-m-d"|after:1900-01-01',
            'pais_nacionalidad' => array('required','in_array:'.$paises),
            'RFC' => array('required','regex:/^[a-zA-Z]{3,4}(\d{6})((\D|\d){3})?$/'),
            'CURP' => array('required','regex:/^[a-zA-Z]{4}\d{6}[a-zA-Z]{6}\d{2}$/'),
            'estado' => 'required|in:Activo,Vetado'
        ];

        $messages = [
            'required' => 'Este campo es obligatorio.',
            'alpha_space' => 'Utilice sólo caracteres del alfabeto y espacios.',
            'alpha_num_space' => 'Utilice sólo caracteres del alfabeto, numeros y espacios.',
            'codigo_postal.digits' => 'El código postal debe estar formado por 5 caracteres numéricos sin espacios.',
            'telefono.regex' => 'El número telefónico debe estar conformado por 10 caracteres numéricos sin espacios.',
            'email' => 'El correo debe estar formado de la siguiente manera: direccion@dominio.com',
            'date' => 'Debe ser una fecha válida',
            'date_format' => 'La fecha de nacimiento debe ser a partir de 1900-01-01',
            'pais_nacionalidad.in_array' => 'Selecciona un país de la lista',
            'RFC.regex' => 'Ingresa un RFC válido.',
            'CURP.regex' => 'Ingresa un CURP válido.',
            'between' => 'Este campo es obligatorio.',
            'in' => 'Este campo es obligatorio.'
        ];

        $validator = Validator::make($data = Input::all(), $rules, $messages);

		if ($validator->fails())
		{
            return Redirect::back()->with('message-type', 'danger')->with('message', 'Algunos datos no han sido propiamente ingresados, favor de revisarlos.')->withErrors($validator)->withInput();
		}

        $data = Input::all();
        $data['creacion'] = date('Y-m-d H:i:s');
        Beneficiario::create($data);

		return Redirect::route('beneficiarios.index')->with('message-type', 'success')
            ->with('message', 'La información se ha guardado correctamente');
	}


	/**
	 * Show the form for editing the specified beneficiario.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$beneficiario = Beneficiario::find($id);
		$paises = $this->paises();
		return View::make('beneficiarios.edit', compact('beneficiario','paises'));
	}

	/**
	 * Update the specified beneficiario in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$beneficiario = Beneficiario::findOrFail($id);
		$paises = base64_encode(serialize($this->paises()));

        Input::merge(array_map('trim', Input::all()));

         $rules = [
            'nombre' => 'required|alpha_space|between:2,255',
            'direccion' => 'required|between:1,255',
            'codigo_postal' => 'required|digits:5',
            'telefono' => array('required','regex:/^[0-9]{10,20}$/'),
            'correo' => 'required|email',
            'fecha_nacimiento' => 'required|date|date_format:"Y-m-d"|after:1900-01-01',
            'pais_nacionalidad' => array('required','in_array:'.$paises),
            'RFC' => array('required','regex:/^[a-zA-Z]{3,4}(\d{6})((\D|\d){3})?$/'),
            'CURP' => array('required','regex:/^[a-zA-Z]{4}\d{6}[a-zA-Z]{6}\d{2}$/'),
            'estado' => 'required|in:Activo,Vetado'
        ];

        $messages = [
            'required' => 'Este campo es obligatorio.',
            'alpha_space' => 'Utilice sólo caracteres del alfabeto y espacios.',
            'alpha_num_space' => 'Utilice sólo caracteres del alfabeto, numeros y espacios.',
            'codigo_postal.digits' => 'El código postal debe estar formado por 5 caracteres numéricos sin espacios.',
            'telefono.regex' => 'El número telefónico debe estar conformado por 10 caracteres numéricos sin espacios.',
            'email' => 'El correo debe estar formado de la siguiente manera: direccion@dominio.com',
            'date' => 'Debe ser una fecha válida',
            'date_format' => 'La fecha de nacimiento debe ser a partir de 1900-01-01',
            'pais_nacionalidad.in_array' => 'Selecciona un país de la lista',
            'RFC.regex' => 'Ingresa un RFC válido.',
            'CURP' => 'Ingresa un CURP válido.',
            'between' => 'Este campo es obligatorio.',
            'in' => 'Este campo es obligatorio.'
        ];

        $validator = Validator::make($data = Input::all(), $rules, $messages);

		if ($validator->fails())
		{
			return Redirect::back()->with('message-type', 'danger')->with('message', 'Algunos datos no han sido propiamente ingresados, favor de revisarlos.')->withErrors($validator)->withInput();
		}

        $beneficiario->update($data);

		return Redirect::route('beneficiarios.index')->with('message-type', 'success')
            ->with('message', 'La información se actualizó correctamente.');
	}

	/**
	 * Remove the specified beneficiario from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Beneficiario::destroy($id);
		return Redirect::route('beneficiarios.index')->with('message-type', 'success')
		->with('message', 'El elemento se eliminó correctamente.');
	}

	private function paises()
	{
		return $countries = ['Afghanistan' => 'Afghanistan','Albania' => 'Albania', 'Algeria' => 'Algeria', 'American Samoa' => 'American Samoa', 'Andorra' => 'Andorra','Angola' => 'Angola', 'Anguilla' => 'Anguilla', 'Antarctica' => 'Antarctica', 'Antigua and Barbuda' => 'Antigua and Barbuda','Argentina' => 'Argentina','Armenia' => 'Armenia','Aruba' => 'Aruba','Australia' =>'Australia', 'Austria' => 'Austria', 'Azerbaijan' => 'Azerbaijan','Bahamas' => 'Bahamas', 'Bahrain' => 'Bahrain','Bangladesh' => 'Bangladesh','Barbados' => 'Barbados','Belarus' => 'Belarus','Belgium' => 'Belgium','Belize' => 'Belize','Benin' => 'Benin','Bermuda' => 'Bermuda','Bhutan' => 'Bhutan','Bolivia' => 'Bolivia','Bosnia and Herzegovina' => 'Bosnia and Herzegovina','Botswana' => 'Botswana','Bouvet Island' => 'Bouvet Island','Brazil' => 'Brazil','British Indian Ocean Territory' => 'British Indian Ocean Territory','Brunei Darussalam' => 'Brunei Darussalam','Bulgaria' => 'Bulgaria','Burkina Faso' => 'Burkina Faso','Burundi' => 'Burundi','Cambodia' => 'Cambodia','Cameroon' => 'Cameroon','Canada' => 'Canada','Cape Verde' => 'Cape Verde','Cayman Islands' => 'Cayman Islands','Central African Republic' => 'Central African Republic','Chad' => 'Chad','Chile' => 'Chile','China' => 'China','Christmas Island' => 'Christmas Island','Cocos (Keeling) Islands' => 'Cocos (Keeling) Islands','Colombia' => 'Colombia','Comoros' => 'Comoros','Congo' => 'Congo','Congo, The Democratic Republic of The' => 'Congo, The Democratic Republic of The','Cook Islands' => 'Cook Islands','Costa Rica' => 'Costa Rica','Cote D\'ivoire' => 'Cote D\'ivoire','Croatia' => 'Croatia','Cuba' => 'Cuba','Cyprus' => 'Cyprus','Czech Republic' => 'Czech Republic','Denmark' => 'Denmark','Djibouti' => 'Djibouti','Dominica' => 'Dominica','Dominican Republic' => 'Dominican Republic','Ecuador' => 'Ecuador','Egypt' => 'Egypt','El Salvador' => 'El Salvador','Equatorial Guinea' => 'Equatorial Guinea','Eritrea' => 'Eritrea','Estonia' => 'Estonia','Ethiopia' => 'Ethiopia','Falkland Islands (Malvinas)' => 'Falkland Islands (Malvinas)','Faroe Islands' => 'Faroe Islands','Fiji' => 'Fiji','Finland' => 'Finland','France' => 'France','French Guiana' => 'French Guiana','French Polynesia' => 'French Polynesia','French Southern Territories' => 'French Southern Territories','Gabon' => 'Gabon','Gambia' => 'Gambia','Georgia' => 'Georgia','Germany' => 'Germany','Ghana' => 'Ghana','Gibraltar' => 'Gibraltar','Greece' => 'Greece','Greenland' => 'Greenland','Grenada' => 'Grenada','Guadeloupe' => 'Guadeloupe','Guam' => 'Guam','Guatemala' => 'Guatemala','Guinea' => 'Guinea','Guinea-bissau' => 'Guinea-bissau','Guyana' => 'Guyana','Haiti' => 'Haiti','Heard Island and Mcdonald Islands' => 'Heard Island and Mcdonald Islands', 'Holy See (Vatican City State)' => 'Holy See (Vatican City State)','Honduras' => 'Honduras','Hong Kong' => 'Hong Kong','Hungary' => 'Hungary','Iceland' => 'Iceland','India' => 'India','Indonesia' => 'Indonesia','Iran, Islamic Republic of' => 'Iran, Islamic Republic of','Iraq' => 'Iraq','Ireland' =>'Ireland','Israel' => 'Israel','Italy' => 'Italy','Jamaica' => 'Jamaica','Japan' => 'Japan','Jordan' => 'Jordan','Kazakhstan' => 'Kazakhstan','Kenya' => 'Kenya','Kiribati' => 'Kiribati','Korea, Democratic People\'s Republic of' => 'Korea, Democratic People\'s Republic of','Korea, Republic of' => 'Korea, Republic of','Kuwait' => 'Kuwait','Kyrgyzstan' => 'Kyrgyzstan','Lao People\'s Democratic Republic' => 'Lao People\'s Democratic Republic', 'Latvia' => 'Latvia','Lebanon' => 'Lebanon','Lesotho' => 'Lesotho','Liberia' => 'Liberia','Libyan Arab Jamahiriya' => 'Libyan Arab Jamahiriya','Liechtenstein' => 'Liechtenstein','Lithuania' => 'Lithuania','Luxembourg' => 'Luxembourg','Macao' => 'Macao','Macedonia, The Former Yugoslav Republic of' => 'Macedonia, The Former Yugoslav Republic of', 'Madagascar' => 'Madagascar','Malawi' => 'Malawi','Malaysia' => 'Malaysia','Maldives' => 'Maldives','Mali' => 'Mali','Malta' => 'Malta','Marshall Islands' => 'Marshall Islands','Martinique' => 'Martinique','Mauritania' => 'Mauritania','Mauritius' => 'Mauritius','Mayotte' => 'Mayotte','Mexico' => 'Mexico','Micronesia, Federated States of' => 'Micronesia, Federated States of','Moldova, Republic of' => 'Moldova, Republic of','Monaco' => 'Monaco','Mongolia' => 'Mongolia','Montserrat' => 'Montserrat','Morocco' => 'Morocco','Mozambique' => 'Mozambique','Myanmar' => 'Myanmar','Namibia' => 'Namibia','Nauru' => 'Nauru','Nepal' => 'Nepal','Netherlands' => 'Netherlands','Netherlands Antilles' => 'Netherlands Antilles','New Caledonia' => 'New Caledonia','New Zealand' => 'New Zealand', 'Nicaragua' => 'Nicaragua','Niger' => 'Niger','Nigeria' => 'Nigeria','Niue' => 'Niue','Norfolk Island' => 'Norfolk Island','Northern Mariana Islands' => 'Northern Mariana Islands','Norway' => 'Norway','Oman' => 'Oman','Pakistan' => 'Pakistan','Palau' => 'Palau','Palestinian Territory, Occupied' => 'Palestinian Territory, Occupied','Panama' => 'Panama','Papua New Guinea' => 'Papua New Guinea','Paraguay' => 'Paraguay','Peru' => 'Peru','Philippines' => 'Philippines','Pitcairn' => 'Pitcairn','Poland' => 'Poland','Portugal' => 'Portugal','Puerto Rico' => 'Puerto Rico', 'Qatar' => 'Qatar','Reunion' => 'Reunion','Romania' => 'Romania','Russian Federation' => 'Russian Federation','Rwanda' => 'Rwanda','Saint Helena' => 'Saint Helena','Saint Kitts and Nevis' => 'Saint Kitts and Nevis','Saint Lucia' => 'Saint Lucia','Saint Pierre and Miquelon' => 'Saint Pierre and Miquelon','Saint Vincent and The Grenadines' => 'Saint Vincent and The Grenadines','Samoa' => 'Samoa','San Marino' => 'San Marino', 'Sao Tome and Principe' => 'Sao Tome and Principe', 'Saudi Arabia' => 'Saudi Arabia', 'Senegal' => 'Senegal','Serbia and Montenegro' => 'Serbia and Montenegro','Seychelles' => 'Seychelles','Sierra Leone' => 'Sierra Leone','Singapore' => 'Singapore','Slovakia' =>'Slovakia','Slovenia' => 'Slovenia','Solomon Islands' => 'Solomon Islands','Somalia' => 'Somalia', 'South Africa' => 'South Africa','South Georgia and The South Sandwich Islands' => 'South Georgia and The South Sandwich Islands','Spain' => 'Spain','Sri Lanka' => 'Sri Lanka','Sudan' => 'Sudan', 'Suriname' => 'Suriname', 'Svalbard and Jan Mayen' => 'Svalbard and Jan Mayen','Swaziland' => 'Swaziland','Sweden' => 'Sweden','Switzerland' => 'Switzerland','Syrian Arab Republic' => 'Syrian Arab Republic','Taiwan, Province of China' => 'Taiwan, Province of China','Tajikistan' => 'Tajikistan','Tanzania, United Republic of' => 'Tanzania, United Republic of','Thailand' => 'Thailand','Timor-leste' => 'Timor-leste','Togo' => 'Togo','Tokelau' => 'Tokelau','Tonga' => 'Tonga','Trinidad and Tobago' => 'Trinidad and Tobago','Tunisia' => 'Tunisia','Turkey' => 'Turkey','Turkmenistan' => 'Turkmenistan','Turks and Caicos Islands' => 'Turks and Caicos Islands','Tuvalu' => 'Tuvalu','Uganda' => 'Uganda','Ukraine' => 'Ukraine','United Arab Emirates' => 'United Arab Emirates','United Kingdom' => 'United Kingdom','United States' => 'United States','United States Minor Outlying Islands' => 'United States Minor Outlying Islands','Uruguay' => 'Uruguay','Uzbekistan' => 'Uzbekistan','Vanuatu' => 'Vanuatu','Venezuela' => 'Venezuela','Viet Nam' => 'Viet Nam','Virgin Islands, British' => 'Virgin Islands, British','Virgin Islands, U.S.' => 'Virgin Islands, U.S.','Wallis and Futuna' => 'Wallis and Futuna','Western Sahara' => 'Western Sahara','Yemen' => 'Yemen','Zambia' => 'Zambia','Zimbabwe' => 'Zimbabwe'];
	}

	public function search()
    {

        $id_beneficiario = Input::get('id_beneficiario');
        $nombre = Input::get('nombre');
        $correo = Input::get('correo');
        $RFC = Input::get('RFC');
        $CURP = Input::get('CURP');
        $estado = Input::get('estado');
        $creacion = Input::get('creacion');

        if(!empty($id_beneficiario) )
            $beneficiarios = Beneficiario::where('id_beneficiario','=',$id_beneficiario)->orderBy('id_beneficiario', 'desc')->simplePaginate(Config::get("constantes.elementos_pagina"));
        else
        {
            $query = Beneficiario::select();
            if(!empty($nombre))
            {
                $query = $query->where('nombre', 'LIKE', "%{$nombre}%");
            }


            if(!empty($correo))
            {
                $query = $query->where('correo', 'LIKE', "%{$correo}%");
            }

            if(!empty($RFC))
            {
                $query = $query->where('RFC', 'LIKE', "%{$RFC}%");
            }

            if(!empty($CURP))
            {
                $query = $query->where('CURP', 'LIKE', "%{$CURP}%");
            }

            if(!empty($estado))
            {
                $query = $query->where('estado', '=', $estado);
            }

            if(!empty($creacion))
            {
                $query = $query->whereRaw("DATE(creacion) = '".$creacion."'");
            }

            
            $beneficiarios = $query->orderBy('id_beneficiario', 'desc')->simplePaginate(Config::get("constantes.elementos_pagina"));


        }

        if($beneficiarios->isEmpty())
        {
            return Redirect::route('beneficiarios.index')
                ->with('message-type', 'warning')
                ->with('message', 'El criterio de búsqueda no regresó ningún resultado.');
        }
        else
        {
            return View::make('beneficiarios.index', compact('beneficiarios'));

        }

    }

}
