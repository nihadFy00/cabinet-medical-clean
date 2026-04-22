<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ordonnance #{{ $ordonnance->id }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: DejaVu Sans, sans-serif; background: #fff0f6; color: #4a0030; }
        .banner { background: linear-gradient(135deg, #ff6eb4, #ff3d8b, #c2006b); padding: 30px 40px 20px; color: white; }
        .banner-inner { display: flex; align-items: center; justify-content: space-between; }
        .clinic-name { font-size: 26px; font-weight: bold; }
        .clinic-sub { font-size: 12px; opacity: 0.85; margin-top: 4px; }
        .rx-badge { width: 64px; height: 64px; background: rgba(255,255,255,0.2); border-radius: 50%; border: 3px solid rgba(255,255,255,0.6); font-size: 26px; font-weight: 900; color: white; text-align: center; line-height: 64px; }
        .body { padding: 30px 40px; }
        .meta-row { display: flex; gap: 16px; margin-bottom: 24px; }
        .meta-card { flex: 1; background: white; border-radius: 14px; padding: 14px 18px; border-left: 5px solid #ff3d8b; box-shadow: 0 2px 10px rgba(255,61,139,0.1); }
        .meta-card .label { font-size: 10px; text-transform: uppercase; letter-spacing: 1px; color: #ff3d8b; font-weight: bold; margin-bottom: 4px; }
        .meta-card .value { font-size: 14px; font-weight: bold; color: #4a0030; }
        .doctor-card { background: linear-gradient(135deg, #ffe0f0, #fff0f6); border-radius: 16px; padding: 18px 22px; margin-bottom: 24px; border: 1px solid #ffb3d9; display: flex; align-items: center; gap: 16px; }
        .doctor-avatar { width: 52px; height: 52px; background: linear-gradient(135deg, #ff6eb4, #ff3d8b); border-radius: 50%; font-size: 18px; font-weight: bold; color: white; text-align: center; line-height: 52px; flex-shrink: 0; }
        .doctor-info .name { font-size: 16px; font-weight: bold; color: #c2006b; }
        .doctor-info .spec { font-size: 12px; color: #9b4070; margin-top: 2px; }
        .section { background: white; border-radius: 16px; padding: 20px 22px; margin-bottom: 20px; box-shadow: 0 2px 12px rgba(255,61,139,0.08); border: 1px solid #ffe0f0; }
        .section-title { font-size: 12px; text-transform: uppercase; letter-spacing: 1.5px; color: #ff3d8b; font-weight: bold; margin-bottom: 12px; }
        .pill { display: inline-block; background: linear-gradient(135deg, #ff6eb4, #ff3d8b); color: white; border-radius: 20px; padding: 6px 16px; font-size: 13px; margin: 4px; }
        .instruction-text { font-size: 13px; line-height: 1.7; color: #4a0030; background: #fff5fa; border-radius: 10px; padding: 12px 16px; border-left: 4px solid #ff6eb4; }
        .footer { margin-top: 30px; display: flex; justify-content: space-between; align-items: flex-end; }
        .validity { font-size: 11px; color: #9b4070; background: #ffe0f0; border-radius: 8px; padding: 8px 14px; }
        .signature-box { text-align: center; border-top: 2px dashed #ffb3d9; padding-top: 10px; width: 180px; }
        .sig-label { font-size: 11px; color: #ff3d8b; font-weight: bold; }
        .sig-name { font-size: 12px; color: #4a0030; margin-top: 4px; }
        .bottom-strip { background: linear-gradient(135deg, #ff6eb4, #ff3d8b, #c2006b); height: 10px; margin-top: 30px; }
    </style>
</head>
<body>
<div class="banner">
    <div class="banner-inner">
        <div>
            <div class="clinic-name"> Cabinet Médical</div>
            <div class="clinic-sub">Votre santé, notre priorité  Soins  Confiance  Excellence</div>
        </div>
        <div class="rx-badge">Rx</div>
    </div>
</div>
<div class="body">
    <div class="meta-row">
        <div class="meta-card">
            <div class="label">Numéro</div>
            <div class="value">#{{ str_pad($ordonnance->id, 4, '0', STR_PAD_LEFT) }}</div>
        </div>
        <div class="meta-card">
            <div class="label">Date</div>
            <div class="value">{{ \Carbon\Carbon::parse($ordonnance->date_ordonnance)->format('d/m/Y') }}</div>
        </div>
        <div class="meta-card">
            <div class="label">Consultation</div>
            <div class="value">#{{ str_pad($ordonnance->consultation_id, 4, '0', STR_PAD_LEFT) }}</div>
        </div>
    </div>
    <div class="doctor-card">
        <div class="doctor-avatar">Dr</div>
        <div class="doctor-info">
            <div class="name">Dr. {{ $ordonnance->consultation->medecin->nom ?? 'Médecin' }} {{ $ordonnance->consultation->medecin->prenom ?? '' }}</div>
            <div class="spec">{{ $ordonnance->consultation->medecin->specialite ?? 'Médecine Générale' }}</div>
        </div>
    </div>
    <div class="section">
        <div class="section-title"> Médicaments prescrits</div>
        @foreach(explode(',', $ordonnance->medicaments) as $med)
            @if(trim($med))<span class="pill"> {{ trim($med) }}</span>@endif
        @endforeach
    </div>
    @if($ordonnance->instructions)
    <div class="section">
        <div class="section-title"> Instructions & Posologie</div>
        <div class="instruction-text">{{ $ordonnance->instructions }}</div>
    </div>
    @endif
    <div class="footer">
        <div class="validity"> Ordonnance valable <strong>3 mois</strong> à compter de la date de prescription</div>
        <div class="signature-box">
            <div style="height:30px"></div>
            <div class="sig-label">Signature & Cachet</div>
            <div class="sig-name">Dr. {{ $ordonnance->consultation->medecin->nom ?? 'Médecin' }}</div>
        </div>
    </div>
</div>
<div class="bottom-strip"></div>
</body>
</html>
