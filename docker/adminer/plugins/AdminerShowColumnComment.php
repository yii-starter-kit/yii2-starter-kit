<?php
/**
 * Adminer plugin
 * Displays column comment in table header data-listing page
 *
 * Install to Adminer on http://www.adminer.org/plugins/
 * @author Tom Higuchi, http://tom-gs.com/
 */

class AdminerShowColumnComment
{
    /**
     * Append column comment to column name.
     *
     * @param array $field
     * @param int $order
     * @return string
     */
    public function fieldName($field, $order = 0)
    {
        $name = Adminer\h($field['field']);
        if (!empty($field['comment'])) {
            $name .= '<br />' . Adminer\h($field['comment']);
        }
        return $name;
    }
}
