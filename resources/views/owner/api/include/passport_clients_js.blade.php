<script type="text/javascript">



$(document).ready(function () {
    prepareComponent();
});

function prepareComponent(){

    getClients();

}

function getClients() {
  axios.get('/oauth/clients')
  .then(function (response) {
    result = response.data;
    var Insert = '';
    $.each(result,function(index,val){
      Insert = Insert + '<tr id="' + val.id + '">';
      Insert = Insert + '<td>' + val.id + '</td>';
      Insert = Insert + '<td>' + val.name + '</td>';
      Insert = Insert + '<td>' + val.secret + '</td>';
      Insert = Insert + '<td><a onClick="edit(' + val.id + ')">edit</td>';
      Insert = Insert + '<td><a onClick="destroy(' + val.id + ')">destroy</td>';
      Insert = Insert + '</tr>';
    });
    $('#clientsData').html(Insert);
  })
  .catch(function (error) {
    ajaxCheckError(error); return;
  });
}

function getClient(id) {
    axios.get('/oauth/clients/' + id)
            .then(function (response) {
                return response.data;
            });
}

function showCreateClientForm() {
    $('#modal-create-client').modal('show');
}


function store() {
    persistClient(
        'post',
        '/oauth/clients',
        this.createForm,
        '#modal-create-client'
    );
}

/**
 * Edit the given client.
 */
function edit(client_id) {

    client = getClient(client_id);
console.log(client);
return;
    $('#edit-client-id').val(client.id);
    $('#edit-client-name').val(client.name);
    $('#edit-client-redirect').val(client.redirect);

    $('#modal-edit-client').modal('show');

}

/**
 * Update the client being edited.
 */
function update() {
    this.persistClient(
        'put', '/oauth/clients/' + this.editForm.id,
        this.editForm, '#modal-edit-client'
    );
}

/**
 * Persist the client to storage using the given form.
 */
function persistClient(method, uri, form, modal) {
    form.errors = [];
    axios[method](uri, form)
        .then(response => {
            this.getClients();
            form.name = '';
            form.redirect = '';
            form.errors = [];
            $(modal).modal('hide');
        })
        .catch(error => {
            if (typeof error.response.data === 'object') {
                form.errors = _.flatten(_.toArray(error.response.data));
            } else {
                form.errors = ['Something went wrong. Please try again.'];
            }
        });
}

/**
 * Destroy the given client.
 */
function destroy(client) {
    axios.delete('/oauth/clients/' + client.id)
            .then(response => {
                this.getClients();
            });
}

</script>