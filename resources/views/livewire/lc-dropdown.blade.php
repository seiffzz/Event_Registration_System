<select
    class="mt-1 block w-full form-input"
    id="lc" name="lc" style="height:44px;">
    <option
        value="6th October University" {{ (old("lc") === '6th October University' ? "selected":"") }}>
        6th October University
    </option>
    <option value="AAST Alexandria" {{ (old("lc") === 'AAST Alexandria' ? "selected":"") }}>AAST
        Alexandria
    </option>
    <option value="AAST in Cairo" {{ (old("lc") === 'AAST in Cairo' ? "selected":"") }}>AAST Cairo
    </option>
    <option
        value="Ain Shams University" {{ (old("lc") === 'Ain Shams University' ? "selected":"") }}>
        Ain Shams University
    </option>
    <option value="Alexandria" {{ (old("lc") === 'Alexandria' ? "selected":"") }}>Alexandria
    </option>
    <option value="AUC" {{ (old("lc") === 'AUC' ? "selected":"") }}>AUC</option>
    <option value="Beni Suef" {{ (old("lc") === 'Beni Suef' ? "selected":"") }}>Beni Suef
    </option>
    <option selected value="Cairo University" {{ (old("lc") === 'Cairo University' ? "selected":"") }}>
        Cairo University
    </option>
    <option value="Damietta" {{ (old("lc") === 'Damietta' ? "selected":"") }}>Damietta</option>
    <option value="GUC" {{ (old("lc") === 'GUC' ? "selected":"") }}>GUC</option>
    <option value="Helwan" {{ (old("lc") === 'Helwan' ? "selected":"") }}>Helwan</option>
    <option value="Kafr Elsheikh {{ (old("lc") === 'Kafr Elsheikh' ? "selected":"") }}">Kafr
        Elsheikh
    </option>
    <option value="Menofia" {{ (old("lc") === 'Menofia' ? "selected":"") }}>Menofia</option>
    <option value="Tanta" {{ (old("lc") === 'Tanta' ? "selected":"") }}>Tanta</option>
    <option value="Luxor & Aswan" {{ (old("lc") === 'Luxor & Aswan' ? "selected":"") }}>Luxor &
        Aswan
    </option>
    <option value="Mansoura" {{ (old("lc") === 'Mansoura' ? "selected":"") }}>Mansoura</option>
    <option value="Minya" {{ (old("lc") === 'Minya' ? "selected":"") }}>Minya</option>
    <option value="MIU" {{ (old("lc") === 'MIU' ? "selected":"") }}>MIU</option>
    <option value="MSA" {{ (old("lc") === 'MSA' ? "selected":"") }}>MSA</option>
    <option value="MUST" {{ (old("lc") === 'MUST' ? "selected":"") }}>MUST</option>
    <option value="Suez" {{ (old("lc") === 'Suez' ? "selected":"") }}>Suez</option>
    <option value="Zagazig" {{ (old("lc") === 'Zagazig' ? "selected":"") }}>Zagazig</option>
</select>
