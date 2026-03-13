@scope($errors->messages(),'errors')
@scope([
'select_elements' => $selectElements ?? [],
])
@script($__self->name)
