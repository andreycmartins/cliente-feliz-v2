$(function () {
    let table = new DataTable('#list-users', {
    });
    
    $('#create-user-btn').click(function() {
        $('#create-user-modal').modal('show');
    });

    $('.delete-btn').click(function() {
        var userId = $(this).data('user-id');
        deleteUser(userId);
    });

    function deleteUser(userId) {
        $.ajax({
            url: '/users/' + userId,
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
            }
        });
    }
});