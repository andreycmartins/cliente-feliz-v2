$(function () {
    let table = new DataTable('#list-users', {
        ajax: {
            url: '/users', // Substitua pelo URL correto para buscar os dados da tabela
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        
        columns: [
            {data: 'id'},
            {data: 'name'},
            {data: 'email'},
            {data: null,  render: function (data, type, row) {
                return `
                    <button class="btn btn-danger delete-btn" data-user-id="${data.id}" value="${data.id}">Excluir</button>    
                `
                }
            },
        ]
    });
    
    $('#create-user-btn').click(function() {
    });

    $(document).on("click", "#create-user-btn", event => {
        $('#create-user-modal').modal('show');
    });


    $(document).on("click", ".delete-btn", event => {
        var userId = $('.delete-btn').val();
        console.log('asd' + userId);
        deleteUser(userId);
    });

    function deleteUser(userId) {
        $.ajax({
            url: '/users/delete/' + userId,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response.message);
                table.ajax.reload()
            },
            error: function(error) {
                console.log('Erro ao excluir o usuário:', error);
                table.ajax.reload()
            }
        });
    }
});