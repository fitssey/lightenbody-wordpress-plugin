<?php foreach($schedule as $item): ?>
    <h2><?php echo date_i18n('l, d F Y', strtotime($item->date)); ?></h2>
    <table>
        <thead>
        <tr>
            <th>Czas</th>
            <th>Klasa</th>
            <th>Nauczyciel</th>
            <th>Poziom</th>
            <th>Lokalizacja</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php if(!isset($item->schedule)): ?>
            <tr><td colspan="6">Brak zajęć na dziś</td></tr>
        <?php else: ;?>
            <?php foreach($item->schedule as $class): ?>
                <tr id="<?php echo $class->referenceId; ?>">
                    <td><?php echo $class->startTime . ' - ' . $class->endTime; ?></td>
                    <td><?php echo $class->classroom->name->{"$locale"}->value; ?></td>
                    <td><?php echo $class->member->user->fullName; ?></td>
                    <td><?php echo $class->classroom->programLevel->name->{"$locale"}->value; ?></td>
                    <td><?php echo $class->room->location->name->{"$locale"}->value; ?></td>
                    <td><a class="lightenbody-schedule-signup-link" href="<?php echo $host . $uuid . "/frontoffice/widget/iframe," . $locale . "," . $class->referenceId ."," . $class->guid . "," . (new DateTime($class->bookingDate))->format('Y-m-d'); ?>">Zapisz się</a></td>
                </tr>
            <?php endforeach; ?>
        <?php endif;?>
        </tbody>
    </table>
<?php endforeach; ?>