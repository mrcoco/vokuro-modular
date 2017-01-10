<script>
    $(document).ready(function(){
        var grid = $("#grid-selection").bootgrid({
            ajax: true,
            url: "{{ url("blog/list") }}",
            selection: true,
            multiSelect: true,
            formatters: {
                "published": function(column, row)
                {
                    if(row.publish == 1){
                        return "Yes";
                    }else{
                        return "No";
                    }
                },
                "commands": function(column, row)
                {
                    return "<button type=\"button\" class=\"btn btn-sm btn-primary command-edit\" data-row-title=\""+row.title+"\" data-row-category=\""+row.category+"\" data-row-id=\"" + row.id + "\"><span class=\"fa fa-pencil\"></span></button> " +
                        "<button type=\"button\" class=\"btn btn-sm btn-primary command-delete\" data-row-id=\"" + row.id + "\"><span class=\"fa fa-trash-o\"></span></button>";
                }
            }
        }).on("loaded.rs.jquery.bootgrid", function()
        {
            $(this).find(".command-edit").off();
            $(this).find(".command-delete").off();
            $(this).find(".command-add").off();

            $(this).find(".command-edit").on("click", function(e)
            {
                myForm('edit',$(this));
                $("#myForm").ajaxForm({
                    url: '{{ url("blog/edit") }}',
                    type: 'post',
                    success: function(data) {
                        myAlert(data);
                        $("#grid-selection").bootgrid("reload");
                        setTimeout(function(){
                            $('#myModal').modal('hide')
                        }, 10000);
                    }
                });

            }).end().find(".command-delete").on("click", function(e)
            {
                $.get( "{{ url('blog/delete/') }}"+ $(this).data("row-id"), function( data ) {
                    myAlert(data);
                    $("#grid-selection").bootgrid("reload");
                });

            });
        });

        $(".actionBar").append(" <div class='btn btn-primary' id='create' class='command-add'><span class=\"fa fa-plus-square-o\"></span> New Page</div>");

    });
</script>