<div class="card">
    <div class="card-heading">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span>
                OAuth Clients
            </span>

            <a class="action-link" onClick="showCreateClientForm">
                Create New Client
            </a>
        </div>
    </div>

    <div class="card-body">
        <!-- Current Clients -->
        <p class="m-b-none" v-if="clients.length === 0">
            You have not created any OAuth clients.
        </p>

        <table class="table table-hover m-b-none" v-if="clients.length > 0">
            <thead>
                <tr>
                    <th>Client ID</th>
                    <th>Name</th>
                    <th>Secret</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>

            <tbody id="clientsData">
            </tbody>
        </table>
    </div>
</div>

<!-- Create Client Modal -->
<div class="modal fade" id="modal-create-client" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title">
                    Create Client
                </h4>
            </div>

            <div class="modal-body">
                <!-- Form Errors -->
                <div class="alert alert-danger" v-if="createForm.errors.length > 0">
                    <p><strong>Whoops!</strong> Something went wrong!</p>
                    <br>
                    <ul>
                        <li v-for="error in createForm.errors">
                             error 
                        </li>
                    </ul>
                </div>

                <!-- Create Client Form -->
                <form class="form-horizontal" role="form">
                    <!-- Name -->
                    <div class="form-group">
                        <label class="col-md-3 control-label">Name</label>

                        <div class="col-md-7">
                            <input id="create-client-name" type="text" class="form-control"
                                                        @keyup.enter="store" v-model="createForm.name">

                            <span class="help-block">
                                Something your users will recognize and trust.
                            </span>
                        </div>
                    </div>

                    <!-- Redirect URL -->
                    <div class="form-group">
                        <label class="col-md-3 control-label">Redirect URL</label>

                        <div class="col-md-7">
                            <input type="text" class="form-control" name="redirect"
                                            @keyup.enter="store" v-model="createForm.redirect">

                            <span class="help-block">
                                Your application's authorization callback URL.
                            </span>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal Actions -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

                <button type="button" class="btn btn-primary" @click="store">
                    Create
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Client Modal -->
<div class="modal fade" id="modal-edit-client" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title">
                    Edit Client
                </h4>
            </div>

            <div class="modal-body">
                <!-- Form Errors -->
                <div class="alert alert-danger" v-if="editForm.errors.length > 0">
                    <p><strong>Whoops!</strong> Something went wrong!</p>
                    <br>
                    <ul>
                        <li v-for="error in editForm.errors">
                             error 
                        </li>
                    </ul>
                </div>

                <!-- Edit Client Form -->
                <form class="form-horizontal" role="form">
                    <input id="edit-client-id" type="hidden" class="form-control" value="" />
                    <!-- Name -->
                    <div class="form-group">
                        <label class="col-md-3 control-label">Name</label>

                        <div class="col-md-7">
                            <input id="edit-client-name" type="text" class="form-control"
                                                        value="">

                            <span class="help-block">
                                Something your users will recognize and trust.
                            </span>
                        </div>
                    </div>

                    <!-- Redirect URL -->
                    <div class="form-group">
                        <label class="col-md-3 control-label">Redirect URL</label>

                        <div class="col-md-7">
                            <input id="edit-client-redirect" type="text" class="form-control" name="redirect"
                                           value="" >

                            <span class="help-block">
                                Your application's authorization callback URL.
                            </span>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal Actions -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

                <button type="button" class="btn btn-primary" @click="update">
                    Save Changes
                </button>
            </div>
        </div>
    </div>
</div> 