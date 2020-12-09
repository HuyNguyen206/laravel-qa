
import { config, library, dom } from '@fortawesome/fontawesome-svg-core';
config.autoReplaceSvg = 'nest';

import { faCaretUp, faCaretDown, faStar, faCheck, faTrash, faPlusCircle } from '@fortawesome/free-solid-svg-icons';
import { faEdit } from '@fortawesome/free-regular-svg-icons';

library.add(faCaretUp, faCaretDown, faStar, faCheck, faEdit, faTrash, faPlusCircle);
// Kicks off the process of finding <i> tags and replacing with <svg>
dom.watch()
