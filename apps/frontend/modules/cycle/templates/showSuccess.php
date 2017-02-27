<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $cycle->getId() ?></td>
    </tr>
    <tr>
      <th>Cycle:</th>
      <td><?php echo $cycle->getCycleId() ?></td>
    </tr>
    <tr>
      <th>Place:</th>
      <td><?php echo $cycle->getPlaceId() ?></td>
    </tr>
    <tr>
      <th>Brigade:</th>
      <td><?php echo $cycle->getBrigade() ?></td>
    </tr>
    <tr>
      <th>Manager:</th>
      <td><?php echo $cycle->getManagerId() ?></td>
    </tr>
    <tr>
      <th>Brigade est:</th>
      <td><?php echo $cycle->getBrigadeEst() ?></td>
    </tr>
    <tr>
      <th>Brigade est2:</th>
      <td><?php echo $cycle->getBrigadeEst2() ?></td>
    </tr>
    <tr>
      <th>Group est:</th>
      <td><?php echo $cycle->getGroupEst() ?></td>
    </tr>
    <tr>
      <th>Group est2:</th>
      <td><?php echo $cycle->getGroupEst2() ?></td>
    </tr>
    <tr>
      <th>Budget:</th>
      <td><?php echo $cycle->getBudgetId() ?></td>
    </tr>
    <tr>
      <th>Staff est:</th>
      <td><?php echo $cycle->getStaffEst() ?></td>
    </tr>
    <tr>
      <th>Staff est2:</th>
      <td><?php echo $cycle->getStaffEst2() ?></td>
    </tr>
    <tr>
      <th>All est:</th>
      <td><?php echo $cycle->getAllEst() ?></td>
    </tr>
    <tr>
      <th>All est2:</th>
      <td><?php echo $cycle->getAllEst2() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('cycle/edit?id='.$cycle->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('cycle/index') ?>">List</a>
