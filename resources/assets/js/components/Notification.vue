<template>
    <div></div>
</template>
<script>
    export default {
        data() {
            return {
                newPostTitle: "",
                newPostDesc: ""
            }
        },
        created() {
            this.listenForChanges();
        },
        methods: {
            listenForChanges() {
                Echo.channel('new-lead')
                    .listen('LeadAction', lead => {
                        if($('meta[name="company"]').attr('content') !== lead.company_id)
                            return;

                        if (! ('Notification' in window)) {
                            alert('Web Notification is not supported');
                            return;
                        }

                        Notification.requestPermission( permission => {
                            let notification = new Notification('New Lead!', {
                                body: lead.msg, // content for the alert
                            });

                            // link to page on clicking the notification
                            notification.onclick = () => {
                                window.open(window.location.href);
                            };
                        });
                    })
            }
        }
    }
</script>