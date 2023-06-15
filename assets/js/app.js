$(document).ready(function(){
    /**
     * 
     */
    $(document).on('click','#del-comment',function(){   
        comment_id = $(this).attr('comment-id');
        if(confirm('are you sure you want to delete your comment?')){
            $.ajax({
                url:"delete_comment.php",
                method:"POST",
                data:{
                    'comment_id':comment_id
                },
                dataType:"JSON",
                success:function(res)
                {
                    load_posts();
                }
            })
        }
    }) 
    /**
     * 
     */
    $(document).on('click','#delete-post',function(){  
        post_id = $(this).attr('post-id');
        if(confirm('are you sure you want to delete your post ?')){
            $.ajax({
                url:"delete_post.php",
                method:"POST",
                data:{
                    'post_id':post_id
                },
                dataType:"JSON",
                success:function(res)
                {
                    load_posts();
                }
            })
        }
    }) 
    /**
     * 
     */
    $(document).on('click','#reply',function(){    
        post_id = $(this).attr('post-id');
        comment = $('#comment-post-'+post_id+'').val();
        if(comment != ''){
            $.ajax({
                url:"create_comment.php",
                method:"POST",
                data:{
                    'post_id':post_id,
                    'comment':comment
                },
                dataType:"JSON",
                success:function(res)
                {
                    load_posts();
                }
            })
        }
        else{
            $('#comment-post-'+post_id+'').css('border','1px solid red');
            $('#comment-post-'+post_id+'').val('write comment here');
            setTimeout(function(){
                $('#comment-post-'+post_id+'').css('border','1px solid #333');
                $('#comment-post-'+post_id+'').val('');
            },1000)
        }
    })

    $(document).on('click','#create-posts',function(){
       $('#post-modal').css('display','block');
    })
    $(document).on('click','#close-post-modal',function(e){
        e.preventDefault();
       $('#post-modal').css('display','none');
    })
    /**
     * 
     */
    $(document).on('submit','#posts-modal-form',function(event){
        event.preventDefault();
        var form_data = $('#posts-modal-form').serialize();
        
        $.ajax({
            url:"create_post.php",
            method:"POST",
            data:form_data,
            dataType:"JSON",
            success:function(res)
            {
                load_posts();
                $('#posts-modal-form')[0].reset();
                $('#post-modal').css('display','none');
            }
        })
    })
    load_posts();
    function load_posts(){
        $.ajax({
            url:"Posts.php",
            method:"POST",
            success:function(res)
            {
                $('#posts-results').html(res);
            }
        })
    }
    fetch_data()
    function fetch_data(){
        fetch('https://jsonplaceholder.typicode.com/todos/1')
        .then(response => response.json())
        .then(data =>
            check_data(data)
        )
    }
    function check_data(data){
        $.ajax({
            url:"json_curl.php",
            method:"POST",
            data:data,
            dataType:"JSON",
            success:function(res)
            {
                
            }
        })
    }
  });





