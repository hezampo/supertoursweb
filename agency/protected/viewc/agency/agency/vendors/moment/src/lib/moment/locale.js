import { getLocale } from '../locale/locales';
import { deprecate } from '../utils/deprecate';

// If passed a locale key, it will set the locale for this
// instance.  Otherwise, it will return the locale configuration
// variables for this instance.
export function locale (key) {
    var newLocaleData