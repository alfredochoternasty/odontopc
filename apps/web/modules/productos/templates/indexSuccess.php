<form>
  <select style="border:none;">
    <?php foreach ($grupos_prod as $grupo): ?>
      <option value="<?php echo $grupo->id ?>"><?php echo $grupo->nombre ?></option>
    <?php endforeach; ?>
  </select>
</form>
<table width="100%" border-spacing="0">
  <tbody>
    <?php foreach ($productos as $producto): ?>
    <tr>
      <td width="15%"><?php echo '<img src="/odontopc/web/uploads/productos/'.$producto->foto_chica.'" height="80vw" width="80vw">' ?></td>
      <td width="50%"><span style="font-size:13pt;font-family: sans-serif;color: #008ddc;font-weight: bold;"><?php echo $producto->getNombre() ?></span>
        <br><span style="font-size:10pt;font-family: sans-serif;color: #e20202;font-weight: bold;"><?php echo $producto->getPrecioVta() ?></span>
      </td>
      <td width="35%">
        <form>
          <input type="text" style="width:40px">
          <input type="submit" value="Pedir" style="
            padding: 5px 10px;
            border: 1px solid #f4800c;
            border-radius: 5px;
            font: normal normal bold 12px/normal Verdana, Geneva, sans-serif;
            color: rgba(255,255,255,0.9);
            background: #f4800c;
          ">
        </form>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>