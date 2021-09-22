comments = (e) => {
     e.preventDefault();
     var whois = $('.myboard').attr('name');
     var postId = e.target.parentElement.parentElement.parentElement.id;
     var comment = $(e.target.children).val();
     var formData = new FormData();
     formData.append("whois", whois);
     formData.append("postId", postId);
     formData.append("comment", comment);
     $.ajax({
         type: "post",
         url: '/comment',
         enctype: 'multipart/form-data',
         data: formData,
         processData: false,
         contentType: false,
         cache: false,
         success: function () {
             $("input[name='comment']").val('');
         }
     });
 };
 $('.commentForm').on('submit', comments);