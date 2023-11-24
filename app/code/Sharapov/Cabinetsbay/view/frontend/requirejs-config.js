var config = {
    paths: {
        'lightslider': "js/lightslider",
        'lightgallery': "js/lightgallery",
        'autoplay': "js/lg-autoplay",
        'fullscreen': "js/lg-fullscreen",
        'hash': "js/lg-hash",
        'pager': "js/lg-pager",
        'share': "js/lg-share",
        'thumbnail': "js/lg-thumbnail",
        'video': "js/lg-video",
        'zoom': "js/lg-zoom"
    },
    shim: {
        'lightslider': {
            deps: ['jquery']
        },
        'lightgallery': {
            deps: ['jquery']
        },
        'autoplay': {
            deps: ['lightgallery']
        },
        'fullscreen': {
            deps: ['lightgallery']
        },
        'hash': {
            deps: ['lightgallery']
        },
        'pager': {
            deps: ['lightgallery']
        },
        'share': {
            deps: ['lightgallery']
        },
        'thumbnail': {
            deps: ['lightgallery']
        },
        'video': {
            deps: ['lightgallery']
        },
        'zoom': {
            deps: ['lightgallery']
        }
    }
};
