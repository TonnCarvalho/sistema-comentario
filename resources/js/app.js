import './bootstrap';
import comments from './alpine/comments'
import reply from './alpine/reply'
import Alpine from 'alpinejs'

window.Alpine = Alpine
Alpine.data('comments', comments)
Alpine.data('reply', reply)
Alpine.start()