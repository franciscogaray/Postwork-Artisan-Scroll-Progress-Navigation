# Artisan Scroll-Progress Navigation
Custom WordPress plugin for Heritage Oakwood Journals.

### Installation
1. Upload the `artisan-scroll-progress` folder to `/wp-content/plugins/`.
2. Activate via the WordPress Dashboard.
3. Configure settings under **Settings > Scroll Progress**.

### Logic
- **Trigger**: Button fades in after 400px of vertical scroll.
- **Progress**: Uses SVG `stroke-dashoffset` calculated against `scrollHeight`.
- **Performance**: Zero dependencies (Vanilla JS).
