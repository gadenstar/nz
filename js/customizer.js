jQuery().ready(function() {
 	jQuery('#icontent').infinitescroll({

    navSelector  : "#navigation",
                   // selector for the paged navigation (it will be hidden)
    nextSelector : "#navigation a",
                   // selector for the NEXT link (to page 2)
    itemSelector : "#icontent .post"
                   // selector for all items you'll retrieve
  });
});


