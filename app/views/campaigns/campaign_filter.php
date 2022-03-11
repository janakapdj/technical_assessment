<h2>Filter Campaigns</h2>
<form action="<?php echo URLROOT; ?>/campaigns/report" method ="POST">
    <label>Campaign Type: </label>
    <select name="campaign_type">
        <option value="SALES">Sales</option>
        <option value="TEST">Test</option>
        <option value="ABC">ABC</option>
    </select><br>
    <label>Start Date: </label>
    <input type="date" name="start_date"></input><br>
    <label>End Date: </label>
    <input type="date" name="end_date"></input><br>
    <button id="submit" type="submit" value="submit">Submit</button>
</form>