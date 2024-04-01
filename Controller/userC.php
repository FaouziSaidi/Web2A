<?php
    class EmployeC
    {
        function show($employe)
        {
            echo '<table border="1" >
            <tr>
                <th>lastName</th>
                <th>firstName</th>
                <th>password</th>
                <th>phone</th>
                <th>email</th>
                <th>date of birth</th>
            </tr>
            <tr>
                <td>'.$employe->get_lastName().'</td>
                <td>'.$employe->get_firstName().'</td>
                <td>'.$employe->get_password().'</td>
                <td>'.$employe->get_phone().'</td>
                <td>'.$employe->get_email().'</td>
                <td>'.$employe->get_dOB().'</td>
            </tr>
        </table>';
        }
    }
?>