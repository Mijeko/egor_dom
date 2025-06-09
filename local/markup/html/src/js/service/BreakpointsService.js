import {reactive} from "vue";

export const breakpoint = reactive({
    name: 'lg',
});

const sizes = {
    '(max-width: 764px)': {
        name: 'xs',
    },
    '(max-width: 989px)': {
        name: 'md',
    },
    '(max-width: 1558px)': {
        name: 'sm',
    },
}

Object.keys(sizes).forEach(size => {
    let media = window.matchMedia(size);

    detectBreakpoint(media);

    media.addEventListener('change', detectBreakpoint);
})


function detectBreakpoint({media, matches}) {
    breakpoint.name = 'lg';

    //console.log('as', matches, media);

    if (matches) {
        breakpoint.name = sizes[media].name;
    }
}


