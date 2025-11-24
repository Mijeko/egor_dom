import createServer from '@inertiajs/core/server'
import Creator from '@/creator'

const ssrInstance = new Creator(import.meta.glob('./pages/**/*.vue', {eager: true}) as any)

createServer(page => ssrInstance.render(page))
