import { computed } from 'vue';

const slugify = (value) => value
    .toString()
    .normalize('NFD')
    .replace(/[\u0300-\u036f]/g, '')
    .replace(/đ/g, 'd')
    .replace(/Đ/g, 'D')
    .toLowerCase()
    .trim()
    .replace(/[^a-z0-9\s-]/g, '')
    .replace(/\s+/g, '-')
    .replace(/-+/g, '-');

export function useContentToc(contentSource, fallbackPrefix = 'noi-dung') {
    return computed(() => {
        const content = typeof contentSource === 'function' ? contentSource() : contentSource?.value || '';

        if (typeof window === 'undefined' || !content) {
            return { html: content, items: [] };
        }

        const documentFragment = new DOMParser().parseFromString(`<div>${content}</div>`, 'text/html');
        const wrapper = documentFragment.body.firstElementChild;
        const headings = Array.from(wrapper.querySelectorAll('h2, h3, h4'));
        const usedIds = new Map();

        const items = headings
            .map((heading, index) => {
                const text = heading.textContent?.trim() || '';
                if (!text) return null;

                const baseId = slugify(text) || `${fallbackPrefix}-${index + 1}`;
                const count = usedIds.get(baseId) || 0;
                usedIds.set(baseId, count + 1);

                const id = count > 0 ? `${baseId}-${count + 1}` : baseId;
                heading.setAttribute('id', id);
                heading.classList.add('scroll-mt-28');

                return {
                    id,
                    text,
                    level: Number(heading.tagName.replace('H', '')),
                };
            })
            .filter(Boolean);

        return {
            html: wrapper.innerHTML,
            items,
        };
    });
}
