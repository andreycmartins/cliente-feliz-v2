$(function () {
    let table = new DataTable('#list-users', {
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json',
        },
        dom: 'Bfrtip',
        buttons: [
            'pdf',
        ],
        ajax: {
            url: '/users',
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },

        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'email' },
            {
                data: null, render: function (data, type, row) {
                    return `
                    <button class="btn btn-primary edit-btn" data-user-id="${data.id}" value="${data.id}" data-bs-toggle="modal" id="edit-btn" data-bs-target="#editarUsuarioModal">Editar</button>
                    <button class="btn btn-danger delete-btn" data-user-id="${data.id}" value="${data.id}">Excluir</button>    
                `
                }
            },
        ]
    });

    $(document).on("click", "#create-user-btn", event => {
        $('#create-user-modal').modal('show');
    });


    $(document).on("click", ".delete-btn", event => {
        var userId = $('.delete-btn').val();
        deleteUser(userId);
    });

    $(document).on("click", ".edit-btn", event => {
        let userId = $(event.currentTarget).val();
        editUser(userId)
    });

    function editUser(userId) {

        $.ajax({
            type: "GET",
            url: '/users/edit/' + userId,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: 'application/json',
            success: function (response) {
                if (!response.error) {
                    $('#idEdit').val(response.dados.id);
                    $('#nameEdit').val(response.dados.name);
                    $('#emailEdit').val(response.dados.email);

                    $('#editarUsuarioModal').modal('show');
                }
                table.ajax.reload()
            },
        });
    }

    function deleteUser(userId) {
        if (confirm("Tem certeza que deseja excluir este cliente?")) {
            $.ajax({
                url: '/users/delete/' + userId,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    table.ajax.reload()
                },
                error: function (error) {
                    console.log('Erro ao excluir o usuário:', error);
                    table.ajax.reload()
                }
            });
        }
    }

    $("#formEdit").on("submit", event => {

        event.preventDefault();

        const formulario = document.getElementById("formEdit");
        const formData = new FormData(formulario);
        const form = Object.fromEntries(new URLSearchParams(formData).entries());

        let data = JSON.stringify(getData(form));
        let userId = $('.edit-btn').val();

        $.ajax({
            type: "put",
            url: '/users/edit/' + userId,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            dataType: 'json',
            contentType: 'application/json',
            success: res => {
                $("#fecharEditar").click();

                if (!res.error) {

                    $('#idEdit').val();
                    $('#nameEdit').val();
                    $('#emailEdit').val();
                    $("#fecharEditar").on('click');

                    table.ajax.reload();

                } else {

                    console.log('erro')

                }

            },
            error: error => {

                const primeiraChave = Object.keys(error.responseJSON.errors)[0];
                const mensagem = error.responseJSON.errors[primeiraChave];

            }

        });

    });

    $("#fecharEditar,#fecharIconeEditar").on("click", event => {

        $('#idEdit').val('');
        $('#nameEdit').val('');
        $('#emailEdit').val('');

    });

    function getData(form) {

        let data = {};
        let formInfo = Object.entries(form);

        formInfo.forEach(([key, value]) => {

            if (value) {

                data[key] = value;

            }

        });

        return data;

    }
});