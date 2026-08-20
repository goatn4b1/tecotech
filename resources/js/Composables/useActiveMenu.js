import { computed } from 'vue';

const normalizePath = (value = '') => {
    if (!value) return '/';

    let path = value;

    try {
        path = new URL(value, window.location.origin).pathname;
    } catch {
        path = value.split('?')[0].split('#')[0];
    }

    if (!path.startsWith('/')) {
        path = `/${path}`;
    }

    return path.length > 1 ? path.replace(/\/+$/, '') : '/';
};

export function useActiveMenu(page) {
    const currentPath = computed(() => normalizePath(page.url || '/'));

    const isActiveLink = (link = '') => {
        const targetPath = normalizePath(link);

        if (targetPath === '/') {
            return currentPath.value === '/';
        }

        return currentPath.value === targetPath || currentPath.value.startsWith(`${targetPath}/`);
    };

    const isActiveMenu = (menu) => {
        if (!menu) return false;

        return isActiveLink(menu.link) || (menu.children || []).some((child) => isActiveLink(child.link));
    };

    return {
        isActiveLink,
        isActiveMenu,
    };
}
