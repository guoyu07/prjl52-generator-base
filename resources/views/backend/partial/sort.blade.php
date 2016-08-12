<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js"></script>
{{-- <script src="/vendor/flat-ui/js/jquery.ui.touch-punch.min.js"></script> --}}
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    var App = {};

    App.notify = {
        message: function(message, type){
            if ($.isArray(message)) {
                $.each(message, function(i, item){
                    App.notify.message(item, type);
                });
            } else {
                $.bootstrapGrowl(message, {
                    type: type,
                    delay: 5000,
                    width: 'auto'
                });
            }
        },

        danger: function(message){
            App.notify.message(message, 'danger');
        },
        success: function(message){
            App.notify.message(message, 'success');
        },
        info: function(message){
            App.notify.message(message, 'info');
        },
        warning: function(message){
            App.notify.message(message, 'warning');
        },
        validationError: function(errors){
            $.each(errors, function(i, fieldErrors){
                App.notify.danger(fieldErrors);
            });
        }
    };

    /**
     * @param  {*} requestData
     */
    var changePosition = function(requestData){

        $.ajax({
            'url': '{{route("backend.sort")}}',
            'type': 'POST',
            'data': requestData,
            'success': function(data) {
                if (data.success) {
                    App.notify.success('排序儲存成功!');
                } else {
                    console.log(data.errors);
                    App.notify.validationError(data.errors);
                }
            },
            'error': function(){
                console.log('Something wrong!');
                App.notify.danger('排序儲存失敗!');
            }
        });
    };

    $(document).ready(function(){
        var $sortableTable = $('.sortable');
        if ($sortableTable.length > 0) {
            $sortableTable.sortable({
                handle: '.sortable-handle',
                axis: 'y',
                update: function(a, b){

                    var entityName = $(this).data('entityname');
                    var $sorted = b.item;

                    var $previous = $sorted.prev();
                    var $next = $sorted.next();

                    if ($previous.length > 0) {
                        changePosition({
                            parentId: $sorted.data('parentid'),
                            type: 'moveAfter',
                            entityName: entityName,
                            id: $sorted.data('itemid'),
                            positionEntityId: $previous.data('itemid')
                        });
                    } else if ($next.length > 0) {
                        changePosition({
                            parentId: $sorted.data('parentid'),
                            type: 'moveBefore',
                            entityName: entityName,
                            id: $sorted.data('itemid'),
                            positionEntityId: $next.data('itemid')
                        });
                    } else {
                        console.error('Something wrong!');
                    }
                },
                cursor: "move"
            });
        }
    });
</script>