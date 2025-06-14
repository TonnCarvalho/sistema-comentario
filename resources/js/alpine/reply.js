export default () => {
    return {
        openModal: false,
        comment: {
            from: '',
            commentId: '',
            postId: ''
        },
        loading: false,
        error: '',
        reply: '',
        eventReceived(event) {
            this.openModal = true;
            this.comment = event.detail,
                console.log(this.comment)
            setTimeout(() => {
                this.$refs.comment.focus()
            }, 200)
        },
        async replayComment() {
            try {
                this.loading = true;
                const response = await fetch('/reply-comment', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('#csrf-token').content,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        comment_id: this.comment.commentId,
                        post_id: this.comment.postId,
                        reply: this.reply
                    })
                });

                if (!response.ok) {
                    const data = await response.json();
                    throw new Error(data.message || 'Something went wrong');
                }

                this.openModal = false;
                window.location.reload();

            } catch (error) {
                if (error?.message) {
                    this.error = error.message;
                }
            } finally {
                this.loading = false;
                this.openModal = false;
            }
            console.log('ola')
        }
    }
}